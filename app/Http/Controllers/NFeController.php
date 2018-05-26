<?php

namespace App\Http\Controllers;
use App\Item;
use App\Client;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use NFePHP\NFe\Make;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Factories\Protocol;
use Illuminate\Support\Facades\File;
use NFePHP\DA\NFe\Danfe;
use NFePHP\DA\Legacy\FilesFolders;

class NFeController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  public static function create($total)
  {
    $nfe = new Make();

    $std = new \stdClass();
    $std->versao = '3.10';
    $nfe->taginfNFe($std);

    $std = new \stdClass();
    $std->cUF = 35;
    $std->cNF = '80070008';
    $std->natOp = 'VENDA';
    $std->indPag = 0;
    $std->mod = 55;
    $std->serie = 1;
    $std->nNF = 2;
    $date_mark = date('Y-m-d');
    $time_mark = date('H:i:s');
    $std->dhEmi = $date_mark.'T'.$time_mark.'-00:00';
    $std->dhSaiEnt = $date_mark.'T'.$time_mark.'-00:00';
    $std->tpNF = 1;
    $std->idDest = 1;
    $std->cMunFG = 3518800;
    $std->tpImp = 1;
    $std->tpEmis = 1;
    $std->cDV = 2;
    $std->tpAmb = 2; // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
    $std->finNFe = 1;
    $std->indFinal = 0;
    $std->indPres = 0;
    $std->procEmi = '0';
    $std->verProc = 1;
    $nfe->tagide($std);

    $std = new \stdClass();
    $std->xNome = 'Lancheria do Hospital São Jerônimo';
    $std->IE = '6564344535';
    $std->CRT = 3;
    $std->CNPJ = '78767865000156';
    $nfe->tagemit($std);

    $std = new \stdClass();
    $std->xLgr = "Avenida Rio Branco";
    $std->nro = '130';
    $std->xBairro = 'Cidade Alta';
    $std->cMun = '4317608';
    $std->xMun = 'São Jerônimo';
    $std->UF = 'RS';
    $std->CEP = '96700000';
    $std->cPais = '1058';
    $std->xPais = 'BRASIL';
    $nfe->tagenderEmit($std);

    $std = new \stdClass();
    $std->xNome = 'Lancheria do Hospital São Jerônimo';
    $std->indIEDest = 1;
    $std->IE = '6564344535';
    $std->CNPJ = '78767865000156';
    $nfe->tagdest($std);

    $std = new \stdClass();
    $std->xLgr = "Avenida Rio Branco";
    $std->nro = '130';
    $std->xBairro = 'Cidade Alta';
    $std->cMun = '4317608';
    $std->xMun = 'São Jerônimo';
    $std->UF = 'RS';
    $std->CEP = '96700000';
    $std->cPais = '1058';
    $std->xPais = 'BRASIL';
    $nfe->tagenderDest($std);

    $std = new \stdClass();
    $std->item = 1;
    $std->cProd = '0001';
    $std->xProd = "Conta (teste)";
    $std->NCM = '66554433';
    $std->CFOP = '5102';
    $std->uCom = 'PÇ';
    $std->qCom = '1.0000';
    $std->vUnCom = number_format($total, 2, '.', '');
    $std->vProd = number_format($total, 2, '.', '');

    $std->uTrib = 'PÇ';
    $std->qTrib = '1.0000';
    $std->vUnTrib = number_format($total, 2, '.', '');
    $std->indTot = 1;
    $nfe->tagprod($std);

    $std = new \stdClass();
    $std->item = 1;
    $std->vTotTrib = '0.00';
    $nfe->tagimposto($std);

    $std = new \stdClass();
    $std->item = 1;
    $std->orig = 0;
    $std->CST = '00';
    $std->modBC = 0;
    $std->vBC = 0;
    $std->pICMS = '18.0000';
    $std->vICMS ='0.00';
    $nfe->tagICMS($std);

    $std = new \stdClass();
    $std->item = 1;
    $std->cEnq = '999';
    $std->CST = '50';
    $std->vIPI = 0;
    $std->vBC = 0;
    $std->pIPI = 0;
    $nfe->tagIPI($std);

    $std = new \stdClass();
    $std->item = 1;
    $std->CST = '07';
    $std->vBC = 0;
    $std->pPIS = 0;
    $std->vPIS = 0;
    $nfe->tagPIS($std);

    $std = new \stdClass();
    $std->item = 1;
    $std->vCOFINS = 0;
    $std->vBC = 0;
    $std->pCOFINS = 0;
    $nfe->tagCOFINSST($std);

    $std = new \stdClass();
    $std->vBC = 0;
    $std->vICMS = 0.00;
    $std->vICMSDeson = 0.00;
    $std->vBCST = 0.00;
    $std->vST = 0.00;
    $std->vProd = number_format($total, 2, '.', '');
    $std->vFrete = 0.00;
    $std->vSeg = 0.00;
    $std->vDesc = 0.00;
    $std->vII = 0.00;
    $std->vIPI = 0.00;
    $std->vPIS = 0.00;
    $std->vCOFINS = 0.00;
    $std->vOutro = 0.00;
    $std->vNF = number_format($total, 2, '.', '');
    $std->vTotTrib = 0.00;
    $nfe->tagICMSTot($std);

    $std = new \stdClass();
    $std->modFrete = 1;
    $nfe->tagtransp($std);

    $std = new \stdClass();
    $std->item = 1;
    $std->qVol = 0;
    $std->esp = '';
    $std->marca = '';
    $std->nVol = '0';
    $std->pesoL = 0.00;
    $std->pesoB = 0.00;
    $nfe->tagvol($std);

    $std = new \stdClass();
    $std->nFat = '100';
    $std->vOrig = 100;
    $std->vLiq = 100;
    $nfe->tagfat($std);

    $std = new \stdClass();
    $std->nDup = '100';
    $std->dVenc = '2018-08-22';
    $std->vDup = number_format($total, 2, '.', '');
    $nfe->tagdup($std);

    $xml = $nfe->getXML();

    $config = [
      "atualizacao" => date('Y-m-d H:i:s'),
      "tpAmb" => 2, // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
      "razaosocial" => "Lancheria do Hospital São Jerônimo (Teste)",
      "siglaUF" => "RS",
      "cnpj" => "78767865000156",
      "schemes" => "PL_008i2",
      "versao" => "3.10",
      "tokenIBPT" => "AAAAAAA"
    ];
    $configJson = json_encode($config);

    $certificadoDigital = File::get(storage_path('1000529304.pfx'));


    $tools = new Tools($configJson, Certificate::readPfx($certificadoDigital, "123456"));
    $xmlAssinado = $tools->signNFe($xml);

    $idLote = str_pad(100, 15, '0', STR_PAD_LEFT); // Identificador do lote
    $resp = $tools->sefazEnviaLote([$xmlAssinado], $idLote);

    $st = new Standardize();
    $std = $st->toStd($resp);
    if ($std->cStat != 103) {
      //erro registrar e voltar
      exit("[$std->cStat] $std->xMotivo");
    }
    $recibo = $std->infRec->nRec; // Vamos usar a variável $recibo para consultar o status da nota

    $protocolo = $tools->sefazConsultaRecibo($recibo);

    $protocol = new Protocol();
    $xmlProtocolado = $protocol->add($xmlAssinado,$protocolo);
    File::put(storage_path('nota.xml'),$xmlProtocolado);
    $docxml = FilesFolders::readFile(storage_path('nota.xml'));
    try {
      $danfe = new Danfe($docxml, 'P', 'A4', 'images/logo.jpg', 'I', '');
      $id = $danfe->montaDANFE();
      $pdf = $danfe->render();
      //o pdf porde ser exibido como view no browser
      //salvo em arquivo
      //ou setado para download forçado no browser
      //ou ainda gravado na base de dados
      header('Content-Type: application/pdf');
      File::put(storage_path('nota.pdf'), $pdf);
      //echo $pdf;
    } catch (InvalidArgumentException $e) {
      echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
    }

    //  $json = $st->toJson($xmlProtocolado);



  }

}
