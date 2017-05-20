<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Page;
use Cuatrovientos\ArteanBundle\Form\Type\PageType;

class PageController extends Controller
{
    /**
     *
     *
     */
    public function indexAction($init=0,$limit=100) {
        $form = $this->createForm(PageType::class);
        $pages = $this->get("cuatrovientos_artean.bo.page")->findAllPages(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.page")->countAllPages();
        return $this->render('CuatrovientosArteanBundle:Page:index.html.twig', array('pages'=>$pages, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(PageType::class, new Page());
        $init = 0;
        $limit = 100;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $page = $form->getData();

                $pages = $this->get("cuatrovientos_artean.bo.page")->searchPages($page, 0, 100);
                $total = count($page);
                return $this->render('CuatrovientosArteanBundle:Page:index.html.twig', array('pages' => $pages, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView()));
            }
        } else {
            $pages = $this->get("cuatrovientos_artean.bo.page")->findAllPages(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.page")->countAllPages();
            return $this->render('CuatrovientosArteanBundle:Page:index.html.twig', array('pages'=>$pages, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
        }
    }

    public function newPageAction()
    {
        $form = $this->createForm(PageType::class);
        return $this->render('CuatrovientosArteanBundle:Page:new.html.twig', array('form'=> $form->createView()));
    }


    public function newPageSaveAction(Request $request)
    {
        //$form = $this->createForm(new PageType(), new Page());
        $form = $this->createForm(PageType::class, new Page());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $page = $form->getData();
                $page->setPermalink($this->permalink($page->getTitle()));
                $page->setWho(1);
                $page->setStatus(1);
                $page->encodeContent();
                $this->get("cuatrovientos_artean.bo.page")->create($page);
                $response =  $this->redirectToRoute("cuatrovientos_artean_page");
                //$response =  $this->render('CuatrovientosArteanBundle:Page:newSave.html.twig', array('page' => $page));
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Page:new.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }


    public function pageDetailAction($id=1)
    {
        $page = $this->get("cuatrovientos_artean.bo.page")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Page:detail.html.twig',array('page'=> $page));
    }


    public function pageUpdateAction($id) {
        $page = $this->get("cuatrovientos_artean.bo.page")->selectById($id);
        $form = $this->createForm(PageType::class, $page);
        return $this->render('CuatrovientosArteanBundle:Page:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }


    public function pageUpdateSaveAction(Request $request) {

        $form = $this->createForm(PageType::class, new Page());
        //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $page = $form->getData();
                $page->encodeContent();
                $page->setPermalink($this->permalink($page->getTitle()));
                $this->get("cuatrovientos_artean.bo.page")->update($page);

                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Page:pageDetail', array('id' => $page->getId()));
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Page:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }


    public function pageDeleteAction($id=1)
    {
        $page = $this->get("cuatrovientos_artean.bo.page")->selectById($id);
        return $this->render('CuatrovientosArteanBundle:Page:delete.html.twig',array('page'=> $page));
    }

    public function pageDeleteSaveAction(Page $page)
    {
        $this->get("cuatrovientos_artean.bo.page")->remove($page);
        return $this->forward('CuatrovientosArteanBundle:Page:index');
    }

    private function permalink ($title) {
        $url = '';
        $patterns = array("/\s+/");
        $subst = array("-");
        $url = preg_replace($patterns, $subst, $title);
        return strtolower($url);
    }
}
