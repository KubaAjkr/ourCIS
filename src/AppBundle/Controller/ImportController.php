<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ImportController extends Controller {

    /**
     * @Route("/import", name="import")
     */
    public function importAction(Request $request) {
        $error = "";

        $form = $this->createFormBuilder()
                ->add('file', FileType::class, array('label' => 'Rozpad zakázky (.xlsx file) - podporována pouze verze 14'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            //$file = $form['file']->getData();
            $NewFilename = 'lastImport.xlsx';
            $dir = './ImportFiles/';
            //$file->move($dir, $file->getClientOriginalName());
            $form['file']->getData()->move($dir, $NewFilename);


            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
            $reader->setLoadAllSheets();
            $reader->setReadDataOnly(true);
            
            $spreadsheet = $reader->load($dir . $NewFilename);
            $spreadsheet->setActiveSheetIndex(0);
            //$spreadsheet->setActiveSheetIndexByName('DataSheet');
            $verRZ = $spreadsheet->getActiveSheet()->getCell('D3')->getValue();

            if ($verRZ <> 14) {
                $error = "Je podporována pouze verze 14 Rozpadu zakázky!";
            }
            else {
                return $this->redirectToRoute('list');
            }


            
        }

        return $this->render('other/import.html.twig', array(
                    'form' => $form->createView(),
                    'error' => $error ,
        ));
    }

}
