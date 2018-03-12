<?php

namespace AppBundle\Controller;

use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 *
 * @author cubias
 */
class AdminController extends Controller {

    /**
     * @Route("/", name="home")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getRepository("AppBundle:MedSds");
        $sdsList = $em->findAll();
        return $this->render('sds/index.html.twig', array('sdsList' => $sdsList));
    }

    /**
     * 
     * @Route("/get_new_modal", name="get_new_modal")
     */
    public function getNewSdsPartialAction() {
        $sdsRequest = new \AppBundle\Entity\MedSdsRequest();
        $html = $this->renderView("sds/modal_sds.html.twig", array("sdsRequest" => $sdsRequest));
        return new Response($html);
    }

    /**
     * 
     * @Route("/get_edit_modal", name="get_edit_modal")
     */
    public function getEditSdsPartialAction(Request $request) {
        $recordId = $request->query->get("record_id");
        $repo = $this->getDoctrine()->getRepository("AppBundle:MedSds");
        $medObject = $repo->find($recordId);
        $sdsRequest = new \AppBundle\Entity\MedSdsRequest();
        $sdsRequest->populateObject($medObject);
        $html = $this->renderView("sds/modal_sds.html.twig", array("sdsRequest" => $sdsRequest));
        return new Response($html);
    }

    /**
     * 
     * @Route("/delete_record", name="delete_record")
     */
    public function deleteAction(Request $request) {
        $aData = array("message_list" => array());
        $em = $this->getDoctrine()->getManager();
        $recordId = $request->query->get("record_id");
        $MedSds = $em->getRepository('AppBundle:MedSds')->find($recordId);
        if (is_null($MedSds)) {
            throw $this->createNotFoundException("Record not Found");
        }
        $em->remove($MedSds);
        $em->flush();
        return new JsonResponse($aData);
    }

    /**
     * 
     * @Route("/do_save_record", name="do_save_record")
     */
    public function doSave(Request $request) {
        $bIsNew = 1;
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository("AppBundle:MedSds");
        $aData = array("error_list" => array(), "oData" => array());
        $uploadFile = new \AppBundle\Entity\UploadFile();
        $form = $this->createForm(\AppBundle\Form\UploadFileType::class, $uploadFile);
        $form->handleRequest($request);
        if (!$form->isValid()) {
            foreach ($form->getErrors() as $error) {
                array_push($aData["error_list"], $error->getMessage());
            }
            return new JsonResponse($aData);
        }
        $oFile = $uploadFile->getFileDoc();
        $aFormParameter = $request->request->all();
        $id = $aFormParameter["record_id"];
        $record = new \AppBundle\Entity\MedSds();
        if (!is_null($id) && strlen($id) > 0) {
            $record = $repo->find($id);
            $bIsNew = 0;
        }
        if (strlen($aFormParameter["input_title"]) == 0  || strlen($aFormParameter["input_manufacturer"]) == 0 || strlen($aFormParameter["input_item_msds_num"]) == 0) {
            array_push($aData["error_list"], "One of the fields is empty");
            return new JsonResponse($aData);
        }
        $record->setSdsTitle($aFormParameter["input_title"]);
        $record->setSdsManufacturer($aFormParameter["input_manufacturer"]);
        $record->setSdsItemMsdsNum($aFormParameter["input_item_msds_num"]);
        if (!is_null($oFile)) {
            $fileName = md5(uniqid()) . '.' . $oFile->guessExtension();
            $oFile->move($this->getParameter('sds_file_directory'), $fileName);
            $record->setSdsFilePath($fileName);
            $record->setSdsFileName($oFile->getClientOriginalName());
        }
        $em->persist($record);
        $em->flush();
        $aData["oData"] = array(
            "title" => $aFormParameter["input_title"], 
            "man" => $aFormParameter["input_manufacturer"],
            "item" => $aFormParameter["input_item_msds_num"],
            "isNew" => $bIsNew,
            "record_id" => $record->getSdsId());
        return new JsonResponse($aData);
    }

}
