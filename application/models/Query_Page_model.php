<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Query_Page_model extends CI_Model {

	public function get_datatables_reject()
	{
        $this->_get_datatables_query_reject();
        if($_POST['length'] != -1){
        $this->db->limit($_POST['start'], $_POST['length']);
    	}
        $query = $this->db->get();
        return $query->result();
	}

	private function _get_datatables_query_reject()
    {
    	$leve = $this->session->type;
		$dep = $this->session->dep;	       
		if ($pos = strrpos($dep, ",")) {
		$depa = array();
		$dep1 = strstr($dep, ",", true);
		$dep2 = strstr($dep, ",");
		$dep2 = str_replace(",","",$dep2);
		array_push($depa, $dep1);
		array_push($depa, $dep2);
		}else{
			$depa = $dep;
		}       
		$column_order = array(null,'PR.prno','PR.refno');   
		$order = array('PR_ref.prno' => 'desc');
        $this->db->from('PR');
        $this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		 
		$this->db->where($where);	  
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
			$this->db->like('PR.prno', $_POST['search']['value']);  
        	$this->db->like('PR.prdate', $_POST['search']['value']);
        	$this->db->like('PR.refno', $_POST['search']['value']);
		}else{
			$this->db->like('PR.prno', $_POST['search']['value']);  
        	$this->db->like('PR.prdate', $_POST['search']['value']);
        	$this->db->like('PR.refno', $_POST['search']['value']);
			$this->db->where_in('dep', $depa);
		} 

        if(isset($_POST['order'])) 
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function count_all_reject()
    {
    	$leve = $this->session->type;
		$dep = $this->session->dep;	       
		if ($pos = strrpos($dep, ",")) {
		$depa = array();
		$dep1 = strstr($dep, ",", true);
		$dep2 = strstr($dep, ",");
		$dep2 = str_replace(",","",$dep2);
		array_push($depa, $dep1);
		array_push($depa, $dep2);
		}else{
			$depa = $dep;
		} 
        $this->db->from('PR');
        $this->db->join('PR_ref', 'PR_ref.prno = PR.prno');		
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
        	$where = "(HDApprove='N' OR PRApprove='N' OR GMApprove='N' OR EFCApprove='N')";
			$this->db->where($where);			
		}else{
            $this->db->where_in('dep', $depa);
        	$where = "(HDApprove='N' OR PRApprove='N' OR GMApprove='N' OR EFCApprove='N')";
			$this->db->where($where);
		}
        return $this->db->count_all_results();
    }

    public function count_filtered_reject()
    {
        $this->_get_datatables_query_reject();
        $query = $this->db->get();
        return $query->num_rows();
    }


}

/* End of file Query_Page_model.php */
/* Location: ./application/models/Query_Page_model.php */
?>