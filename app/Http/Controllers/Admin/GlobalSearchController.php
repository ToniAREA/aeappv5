<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    private $models = [
        'Client'                 => 'cruds.client.title',
        'Boat'                   => 'cruds.boat.title',
        'ContentPage'            => 'cruds.contentPage.title',
        'Wlog'                   => 'cruds.wlog.title',
        'Wlist'                  => 'cruds.wlist.title',
        'ToDo'                   => 'cruds.toDo.title',
        'Appointment'            => 'cruds.appointment.title',
        'ProductCategory'        => 'cruds.productCategory.title',
        'Product'                => 'cruds.product.title',
        'Marina'                 => 'cruds.marina.title',
        'ContactCompany'         => 'cruds.contactCompany.title',
        'ContactContact'         => 'cruds.contactContact.title',
        'Employee'               => 'cruds.employee.title',
        'Provider'               => 'cruds.provider.title',
        'Brand'                  => 'cruds.brand.title',
        'AssetCategory'          => 'cruds.assetCategory.title',
        'Asset'                  => 'cruds.asset.title',
        'FaqCategory'            => 'cruds.faqCategory.title',
        'FaqQuestion'            => 'cruds.faqQuestion.title',
        'Comment'                => 'cruds.comment.title',
        'BookingList'            => 'cruds.bookingList.title',
        'Mlog'                   => 'cruds.mlog.title',
        'TechnicalDocumentation' => 'cruds.technicalDocumentation.title',
        'VideoTutorial'          => 'cruds.videoTutorial.title',
        'Documentation'          => 'cruds.documentation.title',
        'Insurance'              => 'cruds.insurance.title',
    ];

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || ! isset($search['term'])) {
            abort(400);
        }

        $term           = $search['term'];
        $searchableData = [];
        foreach ($this->models as $model => $translation) {
            $modelClass = 'App\Models\\' . $model;
            $query      = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%' . $term . '%');
            }

            $results = $query->take(10)
                ->get();

            foreach ($results as $result) {
                $parsedData           = $result->only($fields);
                $parsedData['model']  = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields      = [];
                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }
                $parsedData['fields_formated'] = $formattedFields;

                $parsedData['url'] = url('/admin/' . Str::plural(Str::snake($model, '-')) . '/' . $result->id . '/edit');

                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }
}
