<?php 
// WHEN YOU GET THE NONE OBJECT PROBLEM USE RESULT() RATHER THAN ROW()
//class Dogs_model extends CI_Model{
    class Count_model extends CI_Model{ 
        
    //Get all the row count
    public function return_all_database_count(){
        $this->load->model('factopedia/Cats_model');
        $this->load->model('factopedia/Cattles_model');
        $this->load->model('factopedia/Cavys_model'); 
        $this->load->model('factopedia/Chickens_model');
        $this->load->model('factopedia/Crocodiles_model');
        $this->load->model('factopedia/Dogs_model');
        $this->load->model('factopedia/Donkeys_model');
        $this->load->model('factopedia/Ducks_model');
        $this->load->model('factopedia/Foxs_model');
        $this->load->model('factopedia/Geeses_model');
        $this->load->model('factopedia/Goats_model');
        $this->load->model('factopedia/Horses_model');
        $this->load->model('factopedia/Marsupials_model');
        $this->load->model('factopedia/Monotremes_model');
        $this->load->model('factopedia/Pigeons_model');
        $this->load->model('factopedia/Pigs_model');
        $this->load->model('factopedia/Ponys_model');
        $this->load->model('factopedia/Rabbits_model');
        $this->load->model('factopedia/Sheeps_model');
        $this->load->model('factopedia/Snakes_model');
        $this->load->model('factopedia/Turkeys_model');
        $this->load->model('factopedia/Turtles_model');
        $this->load->model('factopedia/Carnivors_model');
        $this->load->model('factopedia/Afrosoricidas_model');
        $this->load->model('factopedia/Artiodactylas_model');
        $this->load->model('factopedia/Edentatas_model');
        $this->load->model('factopedia/Diprotodontias_model');
        $this->load->model('factopedia/Cetaceas_model');
        $this->load->model('factopedia/Sirenias_model');
        $this->load->model('factopedia/Hyracoideas_model');
        $this->load->model('factopedia/Macroscelideas_model');
        $this->load->model('factopedia/Proboscideas_model');
        $this->load->model('factopedia/Tubulidentatas_model');
        $this->load->model('factopedia/Dermopteras_model');
        $this->load->model('factopedia/Lagomorphas_model');
        $this->load->model('factopedia/Erinaceomorphas_model');
        $this->load->model('factopedia/Soricomorphas_model');
        $this->load->model('factopedia/Scandentias_model');
        $this->load->model('factopedia/Primates_model');
        $this->load->model('factopedia/Chiropteras_model');
        $this->load->model('factopedia/Rodentias_model');
        $this->load->model('factopedia/Pholidotas_model');
        $this->load->model('factopedia/Perissodactylas_model');
        $this->load->model('factopedia/Agamidaes_model');
        $this->load->model('factopedia/Amphisbaenidaes_model');
        $this->load->model('factopedia/Anguidaes_model');
        $this->load->model('factopedia/Anniellidaes_model');
        $this->load->model('factopedia/Bipedidaes_model');
        $this->load->model('factopedia/Chamaeleonidaes_model');
        $this->load->model('factopedia/Cordylidaes_model');
        $this->load->model('factopedia/Agamidaes_model');
        $this->load->model('factopedia/Amphisbaenidaes_model');
        $this->load->model('factopedia/Anguidaes_model');
        $this->load->model('factopedia/Anniellidaes_model');
        $this->load->model('factopedia/Bipedidaes_model');
        $this->load->model('factopedia/Chamaeleonidaes_model');
        $this->load->model('factopedia/Cordylidaes_model');
        $this->load->model('factopedia/Gekkonidaes_model');
        $this->load->model('factopedia/Gerrhosauridaes_model');
        $this->load->model('factopedia/Helodermatidaes_model');
        $this->load->model('factopedia/Iguanidaes_model');
        $this->load->model('factopedia/Lacertidaes_model');
        $this->load->model('factopedia/Lanthanotidaes_model');
        $this->load->model('factopedia/Pygopodidaes_model');
        $this->load->model('factopedia/Scincidaes_model');
        $this->load->model('factopedia/Teiidaes_model');
        $this->load->model('factopedia/Trogonophidaes_model');
        $this->load->model('factopedia/Varanidaes_model');
        $this->load->model('factopedia/Xantusiidaes_model');
        $this->load->model('factopedia/Xenosauridaes_model');
        $this->load->model('factopedia/Caeciliidaes_model');
        $this->load->model('factopedia/Ichthyophiidaes_model');
        $this->load->model('factopedia/Rhinatrematidaes_model');
        $this->load->model('factopedia/Cryptobranchidaes_model');
        $this->load->model('factopedia/Hynobiidaes_model');
        $this->load->model('factopedia/Ambystomatidaes_model');
        $this->load->model('factopedia/Amphiumidaes_model');
        $this->load->model('factopedia/Proteidaes_model');
        $this->load->model('factopedia/Rhyacotritonidaes_model');
        $this->load->model('factopedia/Sirenidaes_model');
        $this->load->model('factopedia/Salamandridaes_model');
        $this->load->model('factopedia/Plethodontidaes_model');
        $this->load->model('factopedia/Alytidaes_model');
        $this->load->model('factopedia/Bombinatoridaes_model');
        $this->load->model('factopedia/Leiopelmatidaes_model');
        $this->load->model('factopedia/Megophryidaes_model');
        $this->load->model('factopedia/Pelobatidaes_model');
        $this->load->model('factopedia/Centrolenidaes_model');
        $this->load->model('factopedia/Craugastoridaes_model');
        $this->load->model('factopedia/Cycloramphidaes_model');
        $this->load->model('factopedia/Heleophrynidaes_model');
        $this->load->model('factopedia/Hemiphractidaes_model');
        $this->load->model('factopedia/Hemisotidaes_model');
        $this->load->model('factopedia/Hylidaes_model');
        $this->load->model('factopedia/Hyperoliidaes_model');
        $this->load->model('factopedia/Pelodytidaes_model');
        $this->load->model('factopedia/Pipidaes_model');
        $this->load->model('factopedia/Petropedetidaes_model');
        $this->load->model('factopedia/Phrynobatrachidaes_model');
        $this->load->model('factopedia/Ptychadenidaes_model');
        $this->load->model('factopedia/Scaphiopodidaes_model');
        $this->load->model('factopedia/Allophrynidaes_model');
        $this->load->model('factopedia/Aromobatidaes_model');
        $this->load->model('factopedia/Arthroleptidaes_model');
        $this->load->model('factopedia/Brachycephalidaes_model');
        $this->load->model('factopedia/Brevicipitidaes_model');
        $this->load->model('factopedia/Bufonidaes_model');
        $this->load->model('factopedia/Dendrobatidaes_model');
        $this->load->model('factopedia/Dicroglossidaes_model');
        $this->load->model('factopedia/Eleutherodactylinaes_model');
        $this->load->model('factopedia/Leiuperidaes_model');
        $this->load->model('factopedia/Leptodactylidaes_model');
        $this->load->model('factopedia/Mantellidaes_model');
        $this->load->model('factopedia/Micrixalidaes_model');
        $this->load->model('factopedia/Microhylidaes_model');
        $this->load->model('factopedia/Myobatrachidaes_model');
        $this->load->model('factopedia/Nasikabatrachidaes_model');
        $this->load->model('factopedia/Nyctibatrachidaes_model');
		
		$cats        = $this->Cats_model->return_row_count();
		$cattles     = $this->Cattles_model->return_row_count();
		$cavys       = $this->Cavys_model->return_row_count();
		$chickens    = $this->Chickens_model->return_row_count();
		$crocodiles  = $this->Crocodiles_model->return_row_count();
		$dogs        = $this->Dogs_model->return_row_count();
		$donkeys     = $this->Donkeys_model->return_row_count();
		$ducks       = $this->Ducks_model->return_row_count();
		$foxs        = $this->Foxs_model->return_row_count();
		$geeses      = $this->Geeses_model->return_row_count();
		$goats       = $this->Goats_model->return_row_count();
		$horses      = $this->Horses_model->return_row_count();
		$marsupials  = $this->Marsupials_model->return_row_count();
		$monotremes  = $this->Monotremes_model->return_row_count();
		$pigeons     = $this->Pigeons_model->return_row_count();
		$pigs        = $this->Pigs_model->return_row_count();
		$ponys       = $this->Ponys_model->return_row_count();
		$rabbits     = $this->Rabbits_model->return_row_count();
		$sheeps      = $this->Sheeps_model->return_row_count();
		$snakes      = $this->Snakes_model->return_row_count();
		$turkeys     = $this->Turkeys_model->return_row_count();
		$turtles     = $this->Turtles_model->return_row_count();
		$carnivors   = $this->Carnivors_model->return_row_count();
		$afrosoricidas   = $this->Afrosoricidas_model->return_row_count();
		$artiodactylas   = $this->Artiodactylas_model->return_row_count();
		$edentatas   = $this->Edentatas_model->return_row_count();
		$diprotodontias  = $this->Diprotodontias_model->return_row_count();
		$cetaceas    = $this->Cetaceas_model->return_row_count();
		$sirenias    = $this->Sirenias_model->return_row_count();
		$hyracoideas = $this->Hyracoideas_model->return_row_count();
		$macroscelideas  = $this->Macroscelideas_model->return_row_count();
		$proboscideas    = $this->Proboscideas_model->return_row_count();
		$tubulidentatas  = $this->Tubulidentatas_model->return_row_count();
		$dermopteras = $this->Dermopteras_model->return_row_count();
		$lagomorphas = $this->Lagomorphas_model->return_row_count();
		$erinaceomorphas = $this->Erinaceomorphas_model->return_row_count();
		$soricomorphas = $this->Soricomorphas_model->return_row_count();
		$scandentias = $this->Scandentias_model->return_row_count();
		$primates = $this->Primates_model->return_row_count();
		$chiropteras = $this->Chiropteras_model->return_row_count();
		$rodentias = $this->Rodentias_model->return_row_count();
		$pholidotas = $this->Pholidotas_model->return_row_count();
		$perissodactylas = $this->Perissodactylas_model->return_row_count();
		$agamidaes = $this->Agamidaes_model->return_row_count();
		$amphisbaenidaes = $this->Amphisbaenidaes_model->return_row_count();
		$anguidaes = $this->Anguidaes_model->return_row_count();
		$anniellidaes = $this->Anniellidaes_model->return_row_count();
		$bipedidaes = $this->Bipedidaes_model->return_row_count();
		$chamaeleonidaes = $this->Chamaeleonidaes_model->return_row_count();
		$cordylidaes = $this->Cordylidaes_model->return_row_count();
		$agamidaes = $this->Agamidaes_model->return_row_count();
		$amphisbaenidaes = $this->Amphisbaenidaes_model->return_row_count();
		$anguidaes = $this->Anguidaes_model->return_row_count();
		$anguidaes = $this->Anniellidaes_model->return_row_count();
		$bipedidaes = $this->Bipedidaes_model->return_row_count();
		$chamaeleonidaes = $this->Chamaeleonidaes_model->return_row_count();
		$cordylidaes = $this->Cordylidaes_model->return_row_count();
		$gekkonidaes = $this->Gekkonidaes_model->return_row_count();
		$gerrhosauridaes = $this->Gerrhosauridaes_model->return_row_count();
		$helodermatidaes = $this->Helodermatidaes_model->return_row_count();
		$iguanidaes = $this->Iguanidaes_model->return_row_count();
		$lacertidaes = $this->Lacertidaes_model->return_row_count();
		$lanthanotidaes = $this->Lanthanotidaes_model->return_row_count();
		$pygopodidaes = $this->Pygopodidaes_model->return_row_count();
		$scincidaes = $this->Scincidaes_model->return_row_count();
		$teiidaes = $this->Teiidaes_model->return_row_count();
		$trogonophidaes = $this->Trogonophidaes_model->return_row_count();
		$varanidaes = $this->Varanidaes_model->return_row_count();
		$xantusiidaes = $this->Xantusiidaes_model->return_row_count();
		$xenosauridaes = $this->Xenosauridaes_model->return_row_count();
		$caeciliidaes = $this->Caeciliidaes_model->return_row_count();
		$ichthyophiidaes = $this->Ichthyophiidaes_model->return_row_count();
		$rhinatrematidaes = $this->Rhinatrematidaes_model->return_row_count();
		$cryptobranchidaes = $this->Cryptobranchidaes_model->return_row_count();
		$hynobiidaes = $this->Hynobiidaes_model->return_row_count();
		$ambystomatidaes = $this->Ambystomatidaes_model->return_row_count();
		$amphiumidaes = $this->Amphiumidaes_model->return_row_count();
		$proteidaes = $this->Proteidaes_model->return_row_count();
		$rhyacotritonidaes = $this->Rhyacotritonidaes_model->return_row_count();
		$sirenidaes = $this->Sirenidaes_model->return_row_count();
		$salamandridaes = $this->Salamandridaes_model->return_row_count();
		$plethodontidaes = $this->Plethodontidaes_model->return_row_count();
		$alytidaes = $this->Alytidaes_model->return_row_count();
		$bombinatoridaes = $this->Bombinatoridaes_model->return_row_count();
		$leiopelmatidaes = $this->Leiopelmatidaes_model->return_row_count();
		$megophryidaes = $this->Megophryidaes_model->return_row_count();
		$pelobatidaes = $this->Pelobatidaes_model->return_row_count();
		$centrolenidaes = $this->Centrolenidaes_model->return_row_count();
		$craugastoridaes = $this->Craugastoridaes_model->return_row_count();
		$cycloramphidaes = $this->Cycloramphidaes_model->return_row_count();
		$heleophrynidaes = $this->Heleophrynidaes_model->return_row_count();
		$hemiphractidaes = $this->Hemiphractidaes_model->return_row_count();
		$hemisotidaes = $this->Hemisotidaes_model->return_row_count();
		$hylidaes = $this->Hylidaes_model->return_row_count();
		$hyperoliidaes = $this->Hyperoliidaes_model->return_row_count();
		$pelodytidaes = $this->Pelodytidaes_model->return_row_count();
		$pipidaes = $this->Pipidaes_model->return_row_count();
		$petropedetidaes = $this->Petropedetidaes_model->return_row_count();
		$phrynobatrachidaes = $this->Phrynobatrachidaes_model->return_row_count();
		$ptychadenidaes = $this->Ptychadenidaes_model->return_row_count();
		$scaphiopodidaes = $this->Scaphiopodidaes_model->return_row_count();
		$allophrynidaes = $this->Allophrynidaes_model->return_row_count();
		$aromobatidaes = $this->Aromobatidaes_model->return_row_count();
		$arthroleptidaes = $this->Arthroleptidaes_model->return_row_count();
		$brachycephalidaes = $this->Brachycephalidaes_model->return_row_count();
		$brevicipitidaes = $this->Brevicipitidaes_model->return_row_count();
		$bufonidaes = $this->Bufonidaes_model->return_row_count();
		$dendrobatidaes = $this->Dendrobatidaes_model->return_row_count();
		$dicroglossidaes = $this->Dicroglossidaes_model->return_row_count();
		$eleutherodactylinaes = $this->Eleutherodactylinaes_model->return_row_count();
		$leiuperidaes = $this->Leiuperidaes_model->return_row_count();
		$leptodactylidaes = $this->Leptodactylidaes_model->return_row_count();
		$mantellidaes = $this->Mantellidaes_model->return_row_count();
		$micrixalidaes = $this->Micrixalidaes_model->return_row_count();
		$microhylidaes = $this->Microhylidaes_model->return_row_count();
		$myobatrachidaes = $this->Myobatrachidaes_model->return_row_count();
		$nasikabatrachidaes = $this->Nasikabatrachidaes_model->return_row_count();
		$nyctibatrachidaes = $this->Nyctibatrachidaes_model->return_row_count();
		
		$total       = $cats + $cattles + $cavys + $chickens + $crocodiles + $dogs + $donkeys + $ducks + $foxs  + $geeses + $goats + $horses + $marsupials + $monotremes + $pigeons + $pigs + $ponys + $rabbits + $sheeps + $snakes + $turkeys + $turtles + $carnivors + $afrosoricidas + $artiodactylas + $edentatas + $diprotodontias + $cetaceas + $sirenias + $hyracoideas + $macroscelideas + $proboscideas + $tubulidentatas + $dermopteras + $lagomorphas + $erinaceomorphas + $soricomorphas + $scandentias + $primates + $chiropteras + $rodentias + $pholidotas + $perissodactylas + $agamidaes + $amphisbaenidaes  + $anguidaes + $anniellidaes + $bipedidaes + $chamaeleonidaes + $cordylidaes + $agamidaes + $amphisbaenidaes + $anguidaes + $anniellidaes + $bipedidaes + $chamaeleonidaes + $cordylidaes + $gekkonidaes + $gerrhosauridaes + $helodermatidaes + $iguanidaes + $lacertidaes + $lanthanotidaes + $pygopodidaes + $scincidaes + $teiidaes + $trogonophidaes + $varanidaes + $xantusiidaes + $xenosauridaes + $caeciliidaes + $ichthyophiidaes + $rhinatrematidaes + $cryptobranchidaes + $hynobiidaes + $ambystomatidaes + $amphiumidaes + $proteidaes + $rhyacotritonidaes + $sirenidaes + $salamandridaes + $plethodontidaes + $alytidaes + $bombinatoridaes + $leiopelmatidaes + $megophryidaes + $pelobatidaes + $centrolenidaes + $craugastoridaes + $cycloramphidaes + $heleophrynidaes + $hemiphractidaes + $hemisotidaes + $hylidaes + $hyperoliidaes + $pelodytidaes + $pipidaes + $petropedetidaes + $phrynobatrachidaes + $ptychadenidaes + $scaphiopodidaes + $allophrynidaes + $aromobatidaes + $arthroleptidaes + $brachycephalidaes + $brevicipitidaes + $bufonidaes + $dendrobatidaes + $dicroglossidaes + $eleutherodactylinaes + $leiuperidaes + $leptodactylidaes + $mantellidaes + $micrixalidaes + $microhylidaes + $myobatrachidaes + $nasikabatrachidaes + $nyctibatrachidaes ; 
		
		return $total;
    }    
    
}