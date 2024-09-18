<?php
namespace App\Controller;

use App\Entity\Provider;
use App\Entity\TrackTikEmployee;
use App\Service\OAuthService;
use App\Service\TrackTikClient;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController
{

    public function createCustomer(Request $request)
    { 
        $data = json_decode($request->getContent(), true);

        try {
            $employee = $this->getEmployeeFromProvider($data);      
        } catch (Exception $e) {
            return new JsonResponse(['status' => 'error', "message" => $e->getMessage()], 400);
        }   

        $access_token = $this->getAccessToken();
        $trackTikClient = new TrackTikClient($access_token);

        try {
            $employee_id  = $trackTikClient->createEmployee($employee);
        } catch (Exception $e) {
            return new JsonResponse(['status' => 'error', "message" => "Internal Server Error: {$e->getMessage()}"], 500);
        }

        return new JsonResponse(['status' => 'success', 'employee_id' => $employee_id]);
    }

    public function updateCustomer(Request $request, int $employee_id)
    { 
        $data = json_decode($request->getContent(), true);
        try {
            $employee = $this->getEmployeeFromProvider($data);      
        } catch (Exception $e) {
            return new JsonResponse(['status' => 'error', "message" => $e->getMessage()], 400);
        }

        $access_token = $this->getAccessToken();
        $trackTikClient = new TrackTikClient($access_token);

        try {
            if(!$trackTikClient->fetchEmploye($employee_id)) {
                throw new Exception('Invalid employee_id');
            }
            
            $employee_id  = $trackTikClient->updateEmployee($employee_id, $employee);
        } catch (Exception $e) {
            return new JsonResponse(['status' => 'error', "message" => "Internal Server Error: {$e->getMessage()}"], 500);
        }

        return new JsonResponse(['status' => 'success', 'employee_id' => $employee_id]);
    }

    private function getAccessToken(): string 
    {
        $oauth_client = new OAuthService();
        return $oauth_client->getAccessToken();
    }

    private function getEmployeeFromProvider(array $data): TrackTikEmployee 
    {
        $provider = Provider::getProvider($data);
        return $provider->map();
    }

}