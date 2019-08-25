<?php

use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default email templates
        $emailtemplates = [
            [
                'id'=>1,
                'identifier'=>'contactus_template',
                'title'=>'Thank you for Contacting Us!',
                'content'=>'
                    <!DOCTYPE html>
<div style="width: auto; height: auto; position: relative;">
    <h1 style="margin: 0; padding: 0; font-size: 19px; font-family: Arial; font-weight: normal; color: #ffffff; padding: 15px; padding-left: 15px; background: #16A085;">Thank you for contacting Us</h1>
    <div style="width: auto; padding: 15px; padding-bottom: 30px; padding-top: 30px; border: 1px solid #16A085;">
        <p style="margin: 0; padding: 0; font-family: \'arial\'; font-size: 15px; margin-bottom: 10px; color: #555555;">Thank you for your enquiry. It has been forwarded to the relevant department and will be dealt with as soon as possible.</p>
        <p style="margin: 0; padding: 0; font-family: \'arial\',\'sans-serif\'; color: #5EB5E0;margin-bottom: 10px;"></p>
        <p style="margin: 0; padding: 0; font-family: \'arial\'; font-size: 15px; margin-bottom: 3px; color: #555555; padding-bottom: 50px; border-bottom: 1px solid #eeeeee;"></p>
        <p style="font-family: \'arial\'; font-size: 13px; color: #777777; margin-top: 15px;">Team Demo</p>
    </div>
</div>
                ',
                'visible'=>1
            ],
            [
                'id'=>2,
                'identifier'=>'contactus_admin_template',
                'title'=>'New Contact Us Message',
                'content'=>'
                    <!DOCTYPE html>
<div style="width: auto; height: auto; position: relative;">
    <h1 style="margin: 0; padding: 0; font-size: 19px; font-family: Arial; font-weight: normal; color: #ffffff; padding: 15px; padding-left: 15px; background: #16A085;">Customer Message from System</h1>
    <div style="width: auto; padding: 15px; padding-bottom: 30px; padding-top: 30px; border: 1px solid #16A085;">
        <p style="margin: 0; padding: 0; font-family: \'arial\'; font-size: 15px; margin-bottom: 10px; color: #555555;">
        	Name - {{ email.contactus.contactName }} <br/>
        	Email - {{ email.contactus.contactEmail }} <br/>
        	Phone - {{ email.contactus.contactPhone }} <br/>
        	Message - {{ email.contactus.contactMessage }}
        </p>
        <p style="margin: 0; padding: 0; font-family: \'arial\',\'sans-serif\'; color: #5EB5E0;margin-bottom: 10px;"></p>
        <p style="margin: 0; padding: 0; font-family: \'arial\'; font-size: 15px; margin-bottom: 3px; color: #555555; padding-bottom: 50px; border-bottom: 1px solid #eeeeee;"></p>
        <p style="font-family: \'arial\'; font-size: 13px; color: #777777; margin-top: 15px;">Team Support</p>
    </div>
</div>
                ',
                'visible'=>1
            ],
            [
                'id'=>3,
                'identifier'=>'customer_register_template',
                'title'=>'Thank you for the Registration!',
                'content'=> '
                    
                     Hi {{ email.register.name }},
 
 <br><br>Thank you for your interest and our support team will get back to you.
 <br>demolink (which we given with expire time 12hr)<br><br>Team Support<br>
                     
                ',
                'visible'=>1
            ],
            [
                'id'=>4,
                'identifier'=>'customer_register_admin_template',
                'title'=>'New Customer Registration',
                'content'=>'
                    
                     Hi,
 
 <br><br>New user registered,
 <br><br>Name : {{ email.register.name }}
 <br>Company : {{ email.register.company }}
 <br>Email : {{ email.register.email }}<br><br><p>Team Support</p>
                  
                ',
                'visible'=>1
            ],
            [
                'id'=>13,
                'identifier'=>'subscription_expire_customer_template',
                'title'=>'Subscription expired!',
                'content'=>'
                    Hi,<br><br>Subscription expired!<br> 
                ',
                'visible'=>1
            ],
            [
                'id'=>14,
                'identifier'=>'subscription_expire_admin_template',
                'title'=>'Subscription expired!',
                'content'=>'
                    Hi,<br><br>Subscription expired!<br> 
                ',
                'visible'=>1
            ],
            [
                'id'=>15,
                'identifier'=>'staff_register_template',
                'title'=>'New admin registration',
                'content'=>'
                    Hi,<br><br>Username : {{ email.register.email }}<br>Password : {{ email.register.password }}<br>Login Url : http://www.domainname.com/login<br><br> 
                ',
                'visible'=>1
            ]

        ];

        DB::table('email_templates')->delete();

        foreach($emailtemplates as $emailtemplate){
            DB::table('email_templates')->insert($emailtemplate);
        }
    }
}
