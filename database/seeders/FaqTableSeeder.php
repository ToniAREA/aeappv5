<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('faq_categories')->insert([
            [
                'category' => 'General Questions',
                'description' => ''
            ],
            [
                'category' => 'Technical Support',
                'description' => ''
            ],
            [
                'category' => 'Product Information',
                'description' => ''
            ],
            [
                'category' => 'Shipping & Returns',
                'description' => ''
            ],
            [
                'category' => 'Warranty & Repairs',
                'description' => ''
            ],
            [
                'category' => 'Ordering & Payment',
                'description' => ''
            ],
            [
                'category' => 'Account & Profile',
                'description' => ''
            ],
            [
                'category' => 'Privacy & Security',
                'description' => ''
            ],
            [
                'category' => 'Terms & Conditions',
                'description' => ''
            ],
            [
                'category' => 'Contact & Support',
                'description' => ''
            ],
        ]);

        DB::table('faq_questions')->insert([
            [
                
                'question' => 'How do I create an account?',
                'answer' => '<p>To create an account, click on the "Sign Up" link at the top of the page. Fill in your details and click "Create Account." You will receive a confirmation email to activate your account.</p>',
                
            ],
            [
                
                'question' => 'How do I log in to my account?',
                'answer' => '<p>To log in to your account, click on the "Log In" link at the top of the page. Enter your email address and password, then click "Log In." You will be redirected to your account dashboard.</p>',
                
            ],
            [
                
                'question' => 'How do I reset my password?',
                'answer' => '<p>To reset your password, click on the "Forgot Password" link on the login page. Enter your email address, and you will receive an email with instructions on how to reset your password.</p>',
                
            ],
            [
                
                'question' => 'How do I troubleshoot a technical issue?',
                'answer' => '<p>If you are experiencing technical issues, please contact our support team at areaelectronica.es@gmail.com. Provide detailed information about the problem you are facing, and our technicians will assist you in resolving the issue.</p>',
                
            ],

            [
                
                'question' => 'How do I update the firmware on my device?',
                'answer' => '<p>To update the firmware on your device, visit the manufacturer\'s website and download the latest firmware version for your specific model. Follow the instructions provided by the manufacturer to install the firmware update on your device.</p>',
                
            ],
            [
                
                'question' => 'Where can I find product information?',
                'answer' => '<p>You can find product information on our website by browsing the product categories or using the search bar to look up specific products. Each product page contains detailed information, specifications, and customer reviews.</p>',
                
            ],
            [
                
                'question' => 'How do I compare products?',
                'answer' => '<p>To compare products, click on the "Compare" button on the product listing page or product details page. Select the products you want to compare, and the website will display a side-by-side comparison of their features and specifications.</p>',
                
            ],
            [
                
                'question' => 'What are your shipping options?',
                'answer' => '<p>We offer standard shipping, express shipping, and international shipping options. Shipping costs and delivery times vary depending on the shipping method selected and the destination country.</p>',
                
            ],
            [
                
                'question' => 'How do I track my order?',
                'answer' => '<p>To track your order, log in to your account and go to the "Order History" section. Click on the order you want to track, and you will see the tracking information, including the shipping carrier and tracking number.</p>',
                
            ],
            [
                
                'question' => 'What is your warranty policy?',
                'answer' => '<p>We offer a standard 1-year warranty on all products. If you encounter any issues with your product within the warranty period, please contact our support team for assistance with repairs or replacements.</p>',
                
            ],
            [
                
                'question' => 'How do I request a repair?',
                'answer' => '<p>To request a repair, log in to your account and go to the "Repair Requests" section. Fill out the repair request form with details about the issue you are experiencing, and our support team will contact you to arrange the repair process.</p>',
                
            ],
            [
                
                'question' => 'How do I place an order?',
                'answer' => '<p>To place an order, browse our product catalog and add the desired items to your shopping cart. Proceed to checkout, enter your shipping and payment information, and confirm your order. You will receive an order confirmation email once the order is processed.</p>',
                
            ],
            [
                
                'question' => 'What payment methods do you accept?',
                'answer' => '<p>We accept credit card payments, PayPal, and bank transfers. You can select your preferred payment method during the checkout process. Please note that additional fees may apply for certain payment methods.</p>',
                
            ],
            [
                
                'question' => 'How do I update my account information?',
                'answer' => '<p>To update your account information, log in to your account and go to the "Account Settings" section. You can edit your personal details, shipping address, and payment information from this page.</p>',
                
            ],
            [
                
                'question' => 'How do I change my password?',
                'answer' => '<p>To change your password, log in to your account and go to the "Change Password" section. Enter your current password and the new password you want to use, then click "Save Changes" to update your password.</p>',
                
            ],
            [
                
                'question' => 'How do you protect my privacy?',
                'answer' => '<p>We take your privacy and security seriously. We use encryption technology to protect your personal information and ensure that your data is secure. We do not share your
                information with third parties without your consent.</p>',
                
            ],
            [
                
                'question' => 'How do you secure my payment information?',
                'answer' => '<p>We use secure payment gateways to process all transactions and protect your payment information. Your credit card details are encrypted and securely stored, ensuring that your payment information is safe and confidential.</p>',
                
            ],
            [
                
                'question' => 'What are your terms and conditions?',
                'answer' => '<p>Our terms and conditions outline the rules and regulations for using our website and purchasing products from us. By using our website and placing an order, you agree to abide by these terms and conditions.</p>',
                
            ],
            [
                
                'question' => 'What is your refund policy?',
                'answer' => '<p>We offer a 30-day money-back guarantee on all products. If you are not satisfied with your purchase, you can return the item within 30 days for a full refund. Please refer to our refund policy for more details.</p>',
                
            ],
            [
                
                'question' => 'How can I contact customer support?',
                'answer' => '<p>You can contact our customer support team by emailing us at areaelectronica.es@gmail.com. Our support team is available to assist you with any questions or issues you may have regarding our products or services.</p>',
                
            ],
            [
                
                'question' => 'What are your support hours?',
                'answer' => '<p>Our customer support team is available Monday to Friday from 9:00 AM to 5:00 PM EST. If you contact us outside of these hours, we will respond to your inquiry as soon as possible during our regular business hours.</p>',
                
            ],
        ]);
    }
}