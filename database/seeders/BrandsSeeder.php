<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
    [
        'brand' => 'Actisense',
        'brand_url' => 'https://www.actisense.com',
        'description' => 'Actisense provides NMEA 0183 and NMEA 2000 networking products for marine electronics systems.',
    ],
    [
        'brand' => 'Airmar',
        'brand_url' => 'https://www.airmar.com',
        'description' => 'Airmar is known for its sonar transducers and weather monitoring equipment for the marine industry.',
    ],
    [
        'brand' => 'Amphenol',
        'brand_url' => 'https://www.amphenol.com',
        'description' => 'Amphenol designs and manufactures high-performance electronic and fiber optic connectors for the marine industry.',
    ],
    [
        'brand' => 'Anritsu',
        'brand_url' => 'https://www.anritsu.com',
        'description' => 'Anritsu provides communication and navigation systems for maritime and terrestrial use.',
    ],
    [
        'brand' => 'Autonnic',
        'brand_url' => 'https://www.autonnic.com',
        'description' => 'Autonnic offers high-performance marine sensors and components, specializing in fluxgate compasses.',
    ],
    [
        'brand' => 'Barrett Communications',
        'brand_url' => 'https://www.barrettcommunications.com.au',
        'description' => 'Barrett Communications provides HF and VHF communication equipment for vessels and maritime use.',
    ],
    [
        'brand' => 'Beier Radio',
        'brand_url' => 'https://www.beierradio.com',
        'description' => 'Beier Radio specializes in marine automation, control systems, and navigation solutions.',
    ],
    [
        'brand' => 'BEP Marine',
        'brand_url' => 'https://www.bepmarine.com',
        'description' => 'BEP Marine offers electrical solutions including panels, battery switches, and monitoring systems for vessels.',
    ],
    [
        'brand' => 'Blue Sea Systems',
        'brand_url' => 'https://www.bluesea.com',
        'description' => 'Blue Sea Systems designs electrical panels, circuit breakers, and other marine electrical components.',
    ],
    [
        'brand' => 'Bose Marine',
        'brand_url' => 'https://www.bose.com',
        'description' => 'Bose provides high-quality marine audio systems, ensuring robust and durable performance at sea.',
    ],
    [
        'brand' => 'Carlisle & Finch',
        'brand_url' => 'https://www.carlislefinch.com',
        'description' => 'Carlisle & Finch specializes in marine searchlights and lighting solutions for vessels.',
    ],
    [
        'brand' => 'C-MAP',
        'brand_url' => 'https://www.c-map.com',
        'description' => 'C-MAP offers advanced digital cartography and marine mapping solutions.',
    ],
    [
        'brand' => 'ComNav',
        'brand_url' => 'https://www.comnav.com',
        'description' => 'ComNav offers autopilot systems, radars, and marine navigation solutions.',
    ],
    [
        'brand' => 'Cummins Marine',
        'brand_url' => 'https://www.cummins.com',
        'description' => 'Cummins provides marine engines and electrical power generation systems for vessels.',
    ],
    [
        'brand' => 'Danfoss',
        'brand_url' => 'https://www.danfoss.com',
        'description' => 'Danfoss offers advanced marine automation, refrigeration, and cooling systems for ships and yachts.',
    ],
    [
        'brand' => 'DataMarine',
        'brand_url' => 'https://www.datamarine.com',
        'description' => 'DataMarine provides marine instruments such as speed logs, depth sounders, and wind instruments.',
    ],
    [
        'brand' => 'Digital Yacht',
        'brand_url' => 'https://www.digitalyacht.co.uk',
        'description' => 'Digital Yacht offers a range of marine electronics, including AIS, GPS, and Wi-Fi systems for yachts and boats.',
    ],
    [
        'brand' => 'Dometic',
        'brand_url' => 'https://www.dometic.com',
        'description' => 'Dometic provides marine refrigeration, air conditioning, and sanitation systems for boats and yachts.',
    ],
    [
        'brand' => 'Edson Marine',
        'brand_url' => 'https://www.edsonmarine.com',
        'description' => 'Edson Marine offers steering systems, pumps, and accessories for boats and yachts.',
    ],
    [
        'brand' => 'Em-Trak',
        'brand_url' => 'https://www.em-trak.com',
        'description' => 'Em-Trak specializes in AIS transceivers and vessel tracking solutions for both leisure and commercial marine users.',
    ],
    [
        'brand' => 'Fischer Panda',
        'brand_url' => 'https://www.fischerpanda.de',
        'description' => 'Fischer Panda provides generators, hybrid electric systems, and air conditioning units for the marine industry.',
    ],
    [
        'brand' => 'FLIR Systems',
        'brand_url' => 'https://www.flir.com',
        'description' => 'FLIR specializes in thermal imaging, night vision, and infrared camera systems for marine use.',
    ],
    [
        'brand' => 'Floscan',
        'brand_url' => 'https://www.floscan.com',
        'description' => 'Floscan provides fuel monitoring and consumption measurement systems for marine engines.',
    ],
    [
        'brand' => 'Furuno',
        'brand_url' => 'https://www.furuno.com',
        'description' => 'Furuno is a leading provider of marine electronics, specializing in radar systems, fish finders, and GPS navigation.',
    ],
    [
        'brand' => 'Garmin',
        'brand_url' => 'https://www.garmin.com',
        'description' => 'Garmin is a global leader in GPS navigation and marine electronics, offering chartplotters, fish finders, and other marine instruments.',
    ],
    [
        'brand' => 'Glacier Bay',
        'brand_url' => 'https://www.glacierbay.com',
        'description' => 'Glacier Bay offers marine air conditioning systems and refrigeration solutions.',
    ],
    [
        'brand' => 'Glomex',
        'brand_url' => 'https://www.glomex.us',
        'description' => 'Glomex manufactures high-quality antennas for VHF, AIS, and other communication needs on marine vessels.',
    ],
    [
        'brand' => 'Harris Marine',
        'brand_url' => 'https://www.harrismarine.com',
        'description' => 'Harris Marine offers a range of marine electronics and navigation systems for commercial and recreational vessels.',
    ],
    [
        'brand' => 'Hart Systems',
        'brand_url' => 'https://www.hartsystems.com',
        'description' => 'Hart Systems specializes in marine monitoring and control systems, including tank level indicators and alarms.',
    ],
    [
        'brand' => 'Hella Marine',
        'brand_url' => 'https://www.hellamarine.com',
        'description' => 'Hella Marine offers a wide range of LED navigation lighting and other marine lighting solutions.',
    ],
    [
        'brand' => 'Humminbird',
        'brand_url' => 'https://www.humminbird.com',
        'description' => 'Humminbird specializes in fish finders, depth sounders, and sonar technologies for fishing vessels.',
    ],
    [
        'brand' => 'Icom',
        'brand_url' => 'https://www.icomamerica.com',
        'description' => 'Icom specializes in marine radios, including VHF, HF, and SSB communication systems for vessels.',
    ],
    [
        'brand' => 'Indel Marine',
        'brand_url' => 'https://www.indelmarine.com',
        'description' => 'Indel Marine provides marine refrigeration, air conditioning, and water heating systems for boats and yachts.',
    ],
    [
        'brand' => 'Jotron',
        'brand_url' => 'https://www.jotron.com',
        'description' => 'Jotron specializes in emergency communication equipment including EPIRBs, AIS, and VHF radios for marine use.',
    ],
    [
        'brand' => 'JRC',
        'brand_url' => 'https://www.jrc.am',
        'description' => 'JRC (Japan Radio Co.) provides marine radars, navigation systems, and communications equipment.',
    ],
    [
        'brand' => 'Kahlenberg Industries',
        'brand_url' => 'https://www.kahlenberg.com',
        'description' => 'Kahlenberg Industries provides air horns, signaling devices, and accessories for marine vessels.',
    ],
    [
        'brand' => 'Koden',
        'brand_url' => 'https://www.koden-electronics.com',
        'description' => 'Koden is known for its marine radar systems, fish finders, and navigation equipment for commercial vessels.',
    ],
    [
        'brand' => 'KVH',
        'brand_url' => 'https://www.kvh.com',
        'description' => 'KVH is a leader in satellite communications and television systems for marine applications.',
    ],
    [
        'brand' => 'Lars Thrane',
        'brand_url' => 'https://www.larsthrane.com',
        'description' => 'Lars Thrane specializes in satellite communication and navigation systems for maritime applications.',
    ],
    [
        'brand' => 'Lewmar',
        'brand_url' => 'https://www.lewmar.com',
        'description' => 'Lewmar provides anchoring systems, hatches, and winches for yachts and boats.',
    ],
    [
        'brand' => 'Lofrans',
        'brand_url' => 'https://www.lofrans.com',
        'description' => 'Lofrans is a leading manufacturer of marine windlasses and anchoring systems.',
    ],
    [
        'brand' => 'Lowrance',
        'brand_url' => 'https://www.lowrance.com',
        'description' => 'Lowrance provides a wide range of fish finders, sonar, and GPS devices for both commercial and recreational fishing.',
    ],
    [
        'brand' => 'Mackay Marine',
        'brand_url' => 'https://www.mackaymarine.com',
        'description' => 'Mackay Marine provides a range of marine electronics, communication, and navigation solutions.',
    ],
    [
        'brand' => 'Maretron',
        'brand_url' => 'https://www.maretron.com',
        'description' => 'Maretron provides vessel monitoring and control solutions for modern yachts and commercial vessels.',
    ],
    [
        'brand' => 'Mastervolt',
        'brand_url' => 'https://www.mastervolt.com',
        'description' => 'Mastervolt specializes in power electronics for the marine industry, including battery chargers and inverters.',
    ],
    [
        'brand' => 'Marinetech',
        'brand_url' => 'https://www.marinetech.com',
        'description' => 'Marinetech specializes in thrusters, bow thrusters, and stabilizer systems for yachts and boats.',
    ],
    [
        'brand' => 'MX Marine',
        'brand_url' => 'https://www.mxmarine.com',
        'description' => 'MX Marine offers high-quality GPS and navigation systems for professional and recreational vessels.',
    ],
    [
        'brand' => 'Navico',
        'brand_url' => 'https://www.navico.com',
        'description' => 'Navico is a parent company of multiple marine electronics brands including Simrad, Lowrance, and B&G.',
    ],
    [
        'brand' => 'Navionics',
        'brand_url' => 'https://www.navionics.com',
        'description' => 'Navionics provides advanced marine charts and navigation apps for recreational boating and fishing.',
    ],
    [
        'brand' => 'Ocean Signal',
        'brand_url' => 'https://www.oceansignal.com',
        'description' => 'Ocean Signal provides life-saving maritime safety products including EPIRBs, SARTs, and PLBs.',
    ],
    [
        'brand' => 'Onwa Marine',
        'brand_url' => 'https://www.onwamarine.com',
        'description' => 'Onwa Marine provides GPS chartplotters, radars, and marine communication systems at affordable prices.',
    ],
    [
        'brand' => 'Panther Marine',
        'brand_url' => 'https://www.panthermarineproducts.com',
        'description' => 'Panther Marine provides steering and trim control systems for outboard motors and boats.',
    ],
    [
        'brand' => 'Quick Nautical Equipment',
        'brand_url' => 'https://www.quicknauticalequipment.com',
        'description' => 'Quick offers windlasses, thrusters, and stabilizers for yachts and marine vessels.',
    ],
    [
        'brand' => 'Raymarine',
        'brand_url' => 'https://www.raymarine.com',
        'description' => 'Raymarine provides a full line of marine electronics including autopilots, radars, sonar systems, and navigation displays.',
    ],
    [
        'brand' => 'Samyung',
        'brand_url' => 'https://www.samyungenc.com',
        'description' => 'Samyung specializes in marine communication and navigation systems for commercial vessels.',
    ],
    [
        'brand' => 'Sailor Marine',
        'brand_url' => 'https://www.sailormarine.com',
        'description' => 'Sailor Marine provides satellite communication systems and radios for the marine industry.',
    ],
    [
        'brand' => 'Scanstrut',
        'brand_url' => 'https://www.scanstrut.com',
        'description' => 'Scanstrut designs mounts and supports for marine electronics such as radars, GPS, and antennas.',
    ],
    [
        'brand' => 'Seiwa',
        'brand_url' => 'https://www.seiwa.com',
        'description' => 'Seiwa offers a range of marine GPS plotters, radars, and sonar equipment for navigation and fishing.',
    ],
    [
        'brand' => 'Shakespeare Marine',
        'brand_url' => 'https://www.shakespeare-marine.com',
        'description' => 'Shakespeare Marine manufactures antennas and communication products for the marine environment.',
    ],
    [
        'brand' => 'Si-Tex',
        'brand_url' => 'https://www.si-tex.com',
        'description' => 'Si-Tex manufactures marine electronics such as fish finders, GPS chartplotters, and radar systems.',
    ],
    [
        'brand' => 'Simrad',
        'brand_url' => 'https://www.simrad-yachting.com',
        'description' => 'Simrad offers marine electronics for professional and recreational vessels, focusing on GPS, autopilot systems, and radars.',
    ],
    [
        'brand' => 'Standard Horizon',
        'brand_url' => 'https://www.standardhorizon.com',
        'description' => 'Standard Horizon specializes in marine communication radios, including VHF handheld and fixed-mount radios.',
    ],
    [
        'brand' => 'Victron Energy',
        'brand_url' => 'https://www.victronenergy.com',
        'description' => 'Victron Energy specializes in power conversion products such as inverters, battery chargers, and solar panels for marine use.',
    ],
    [
        'brand' => 'Vesper Marine',
        'brand_url' => 'https://www.vespermarine.com',
        'description' => 'Vesper Marine is known for its advanced AIS systems and smart navigation solutions.',
    ],
    [
        'brand' => 'Xantrex',
        'brand_url' => 'https://www.xantrex.com',
        'description' => 'Xantrex provides reliable power inverters, chargers, and battery monitoring solutions for marine use.',
    ]
];

        foreach ($brands as $brand) {
            Brand::create([
                'is_online' => true, // Assuming all brands are online; adjust as necessary
                'brand' => $brand['brand'],
                'brand_url' => $brand['brand_url'],
                'description' => $brand['description'],
                'notes' => null, // No specific notes provided, can be filled later
                'internal_notes' => null, // No internal notes provided
                'link' => null, // No specific link, can be filled later
                'link_description' => null, // No link description
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
        }
    }
}