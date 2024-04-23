<?php

namespace App\Controller;

use App\Form\MyFormType;
use App\Service\TimeCalcService;
use DateTime;
use DateTimeZone;
use Exception;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MyFormController extends AbstractController
{
    private timeCalcService $timeCalcService;

    public function __construct(TimeCalcService $timeCalcService)
    {
        $this->timeCalcService = $timeCalcService;
    }

    /**
     * @Route("/my/form", name="app_my_form")
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(MyFormType::class);
        $form->handleRequest($request);
        $formData = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            $date    = new DateTime($formData['date'], new DateTimeZone($formData['timezone']));
            $dateFeb = new DateTime($date->format('Y') . '-02-01');
            $dateUtc = new DateTime($formData['date'], new DateTimeZone('UTC'));

            $formData['diff_minutes'] = $this->timeCalcService->diffMinutes($dateUtc, $date);
            $formData['month']        = $date->format('F');
            $formData['month_days']   = $date->format('t');
            $formData['month_feb']    = $dateFeb->format('t');
        }

        return $this->render('my_form/index.html.twig', [
            'form'     => $form->createView(),
            'formData' => $formData,
        ]);
    }

}
