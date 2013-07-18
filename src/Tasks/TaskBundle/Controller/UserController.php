<?php
namespace Tasks\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use Tasks\TaskBundle\Entity\Task;

class UserController extends Controller
{
    function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository("TaskBundle:Task")->findAll();

        return $this->render("TaskBundle:User:index.html.twig", array(
            'tasks' => $tasks,
        ));
    }

    function viewAction($id_task)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository("TaskBundle:Task")->find($id_task);
        if (!$task) {
            throw $this->createNotFoundException();
        }


        return $this->render("TaskBundle:User:view.html.twig", array(
            'task' => $task,
        ));
    }
}