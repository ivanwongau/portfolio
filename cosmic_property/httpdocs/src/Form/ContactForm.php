<?php


namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\Mailer\Email;

class ContactForm extends Form
{
    protected function _buildSchema(Schema $schema)
    {
        return $schema
            ->addField('name', ['type'=>'string','label'=>'NAME','required'=>true])
            ->addField('email', ['type' => 'string','label'=>'NAME','required'=>true])
            ->addField('topic', ['type' => 'string','label'=>'NAME','required'=>true])
            ->addField('body', ['type' => 'text','label'=>'NAME','required'=>true]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator->add('name', 'length', [
            'rule' => ['minLength', 4],
            'message' => 'A name is required'
        ])->add('email', 'format', [
            'rule' => 'email',
            'message' => 'A valid email address is required',
        ]);

        return $validator;
    }

    protected function _execute(array $data)
    {
        // Send an email.
//        https://stackoverflow.com/questions/43994876/how-to-get-data-from-input-form-cakephp-3/43996679
        $name = $data['name'];
        $emailFrom = $data['email'];
        $topic = $data['topic'];
        $message = $data['body'];

        $mailTo = 'maxi.purnomo@gmail.com';

        $email = new Email('default');
        $email->from([$emailFrom => 'My Site'])
            ->sender($emailFrom, 'Cosmic Property Contact Us page')
//            ->profile(['from' => $emailFrom, 'transport' => 'my_custom'])
            ->to($mailTo)
            ->subject($topic)
            ->send("Hi there is an email from " . $name . ".\nThe email is " . $emailFrom . " .\nThe topic is about " .
                $topic . ".\nThe message is :\n" . $message);
        return true;
    }
}
