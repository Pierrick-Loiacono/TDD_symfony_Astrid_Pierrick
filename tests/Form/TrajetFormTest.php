<?php

namespace App\Tests\Entity;


use App\Entity\Trajet;
use App\Form\TrajetType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Constraints\DateTime;


class TrajetFormTest extends TypeTestCase
{

    public function testSubmitTrajetForm()
    {
        $formData = [
            'date' => new \DateTime(),
        ];

        $objectToCompare = new Trajet();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(TrajetType::class, $objectToCompare);

        $object = new Trajet();
        $object->setDate($formData['date']);
        // ...populate $object properties with the data stored in $formData

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

}
