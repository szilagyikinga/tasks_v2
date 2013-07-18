<?php


namespace Tasks\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tasks\TaskBundle\Entity\Task;
use Tasks\TaskBundle\Form\TaskType;

class AdminController extends Controller
{

    public function editAction($id_task)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository("TaskBundle:Task")->find($id_task);
        if (!$task) {
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new TaskType(), $task);
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $t = $form->getData();
                $this->saveAction($t);
                return $this->redirect($this->generateUrl("Task_view", array(
                    'id_task' => $t->getId(),
                )));
            }
        }
        return $this->render("TaskBundle:Admin:edit.html.twig", array(
            'form' => $form->createView(),
            'id_task' => $id_task,

        ));
    }

    public function createAction()
    {
        $t = new Task();
        $form = $this->createForm(new TaskType(), $t);
        return $this->render("TaskBundle:Admin:create.html.twig", array(
            'form' => $form->createView()
        ));
    }

    public function createProcessAction()
    {
        $t = new Task();
        $form = $this->createForm(new TaskType(), $t);
        $request = $this->getRequest();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $t = $form->getData();
            $user = $this->getUser();
            $t->setCreatedBy($user);
            $this->saveAction($t);
            return $this->redirect($this->generateUrl("Task_view", array(
                'id_task' => $t->getId(),
            )));
        }
        return $this->render("TaskBundle:Admin:create.html.twig", array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction($id_task)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository("TaskBundle:Task")->find($id_task);
        if (!$task) {
            throw $this->createNotFoundException();
        }
        $em->remove($task);
        $em->flush();
        return $this->redirect($this->generateUrl('Task_home'));
    }

    private function saveAction($data)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
    }

}