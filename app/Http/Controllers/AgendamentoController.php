<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Agenda;

class AgendamentoController extends Controller
{
    private $base_url ="https://api.feegow.com/v1/api/";
    private $token;
    
    public function __construct()
    {
        $this->token = env("APP_CLINICA_TOKEN","Default");
    }

    public function index()
    {
        //dd($this->token);
        $data = $this->GetApiData('specialties/list');
        $data2 = $this->getOrigens();
        return view('welcome')->with(['especialidades'=> $data, 'origem'=> $data2]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $agenda = new Agenda();
        $agenda->fill($input);
        $agenda->date_time = date("Y-m-d H:i:s");

        try {
            $agenda->save();
            return ['code'=> 0 , 'msg'=>'Seus dados foram salvos com sucesso!', 'obj'=>$agenda];

        } catch (\Exception $e) {
            return ['code'=> 1 , 'msg'=>'houve um erro ao salvar seus dados!\n'.$e, 'obj'=>$agenda];
        }
        
    }
    
    public function getProfissionais($id)
    {
        try {
            $data = $this->GetApiData('professional/list?especialidade_id='.$id);
            return response()->json($data);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getOrigens()
    {
        $data = $this->GetApiData('patient/list-sources');
        return $data;
    }

    public function GetApiData($caminho)
    {
        $client = new Client();
        $response = $client->request('GET', $this->base_url.$caminho,[
            'headers' => [

                'x-access-token'=> $this->token,
            ]]);
        $data = json_decode($response->getBody(),true);
        
        return $data['content'];
    }
}
