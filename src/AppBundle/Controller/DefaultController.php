<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Tag;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use AppBundle\Form\TagType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }


    /**
     * @Route("/task/new", name="new_task")
     */
    public function newAction(Request $request)
    {
        $em   = $this->get('doctrine.orm.entity_manager');
        $task = new Task();

        // foreach (range(0, 15) as $i) {
        //     $tag = new Tag();
        //     $tag->name = sprintf('tag %d', $i);
        //     $em->persist($tag);
        // }

        // $tag1 = new Tag();
        // $tag1->name = 'tag1';
        // $task->getTags()->add($tag1);
        // $tag2 = new Tag();
        // $tag2->name = 'tag2';
        // $task->getTags()->add($tag2);

        $form = $this->createForm(new TaskType(), $task);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($task);
            $em->flush();
        }

        return $this->render('AppBundle:Task:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/task/newstep", name="new_task_step")
     *
     * @return Response
     */
    public function flowNewAction()
    {
        $task = new Task();
        $flow = $this->get('task.form.flow.create_task');

        $flow->bind($task);

        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em   = $this->get('doctrine.orm.entity_manager');

                $em->persist($task);
                $em->flush();

                $flow->reset();

                return $this->redirect($this->generateUrl('home'));
            }
        }

        return $this->render('AppBundle:Task:new.html.twig', array(
            'form' => $form->createView(),
            'flow' => $flow,
        ));
    }


    /**
     * @Route("/home", name="home")
     *
     * @return Response
     */
    public function homeAction()
    {
        return new Response('end of the story guys!!');
    }
}
