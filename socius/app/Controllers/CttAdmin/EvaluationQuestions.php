<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class EvaluationQuestions extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function evaluationquestionslisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			
			$data = $this->adminvars->variables(); //Admin Variable Load
			
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$sub_dept_id = $this->request->getVar('sub_dept_id'); 
				$data['QsEvaluationQuestions'] = $this->admin->retrive_all_cond_data('*',tbl_evaluation_question,'is_delete="0" AND sub_department_id = "'.$sub_dept_id.'"', 'id','DESC');
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-evaluation-questions/adm-evaluation-questions-listing', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
			else
			{
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-evaluation-questions/adm-evaluation-questions-listing', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add offers
	public function addevaluationquestions()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$evaluationquestions_name = $this->request->getVar('evaluationquestions_name'); 
				$data = [
					'evaluationquestions_name' => $evaluationquestions_name
					];
				//Insert form data
				$error_code = $this->admin->form_insert(tbl_evaluation_question,$data);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'evaluation question', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-evaluation-questions/adm-add-evaluationquestions', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MEQ_AddMsg);
					return redirect()->to( site_url('ctt-admin/evaluation-questions-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-evaluation-questions/adm-add-evaluationquestions', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Edit Industry
	public function editevaluationquestions()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$segmentRemove = array_filter($this->request->uri->getSegments());
		$segment = array_values($segmentRemove);
		if(!empty($adminId))
		{
			$id = $segment[2];
			if($this->request->getVar()) 
			{
				$question = $this->request->getVar('question');
				$data = [
					'question' => $question,
					'updated_date' => date('Y-m-d'),
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_evaluation_question,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'evaluation questions', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_evaluation_question, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-evaluation-questions/adm-add-evaluationquestions', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MEQ_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/evaluation-questions-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_evaluation_question, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-evaluation-questions/adm-add-evaluationquestions', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete Industry
	public function deleteevaluationquestions()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$error_code = $this->admin->deleteRow(tbl_evaluation_question,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'evaluation questions', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/evaluation-questions-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MEQ_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/evaluation-questions-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	
	//Search Industry
	public function searchevaluationquestions()
    {
		$data = $this->adminvars->variables(); 
		// Get search term 
		$sub_dept_id = $_REQUEST['sub_dept_id'];
		
		$QsEvaluationQuestions = $this->admin->retrive_all_cond_data('*',tbl_evaluation_question,'is_delete="0" AND sub_department_id = "'.$sub_dept_id.'"', 'id','ASC'); 
		// Generate array with skills data 
		/* $skillData = array(); 
		if(!empty($QsEvaluationQuestions)){ 
			foreach($QsEvaluationQuestions as $RsEvaluationQuestions)
			{
				$data['id'] = $RsEvaluationQuestions->id; 
				$data['value'] = $RsEvaluationQuestions->question; 
				array_push($skillData, $data); 
			} 
		} */ 
		?>
		
		<table id="datatable" class="table table-hover table-bordered w-100">
				<thead class="bg-primary text-white text-center">
					<tr>
						<th><?=$data['SL'];?></th>
						<th width="50px;"><?=$data['MEQ_EvaluationQuestion'];?></th>
						<th data-sortable="false" class="notexport"><?=$data['Action'];?></th>
					</tr>
				</thead>
				<tbody >
					<?php 
					if(!empty($QsEvaluationQuestions))//Check Count
					{
						$i=0;
						foreach($QsEvaluationQuestions as $RsEvaluationQuestions)
						{ 
						$i++;
					?>
					<tr class="text-left">
						<td><?=$i;?></td>
						<td ><?=$this->admin->HtmlStripSlash($RsEvaluationQuestions->question);?><br><br>
						<?php
					$QsEvaluationPoints = $this->admin->retrive_all_cond_data('*',tbl_evaluation_points,'is_delete="0" AND evaluation_question_id = "'.$RsEvaluationQuestions-> id.'"', 'id','ASC'); 
						
						if(!empty($QsEvaluationPoints))//Check Count
						{	
						$k = 0;
							foreach($QsEvaluationPoints as $RsEvaluationPoints)
							{ 
							$alphabet  = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
							//print_r($alphabet);exit;
							?>
							<?php echo $alphabet[$k]; ?> .<?php echo $RsEvaluationPoints->point_name; ?> - <?php echo $RsEvaluationPoints->points; ?> Points<br>
 						
						<?php  	$k++; } } ?>	
						</td>
						
						<td class="text-center">
							<div class="btn-group btn-group-sm">
								<!--<button type="button" title="<?=$title;?>" class="btn btn-sm btn-<?=$Class;?>" data-toggle="modal" data-userid="<?=$RsEvaluationQuestions->id;?>" data-title="<?=$title;?>" data-statusfun="<?=$StatusFun;?>" data-target="#modal-active-confirm"><span class="<?=$icon;?>"></span></button>&nbsp;&nbsp;-->
								<a href="<?=site_url();?>ctt-admin/edit-evaluation-questions/<?=$RsEvaluationQuestions->id;?>" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
								<!--<button type="button" class="btn btn-sm btn-danger"  data-toggle="modal"  data-deluserid="<?=$RsEvaluationQuestions->id;?>" data-target="#modal-delete-confirm" title="Delete" style="background-color: #f71a1a"><span class="fa fa-trash"></span></button>-->
							</div>
						</td>
					</tr>
					<?php } } else { ?>
					<tr><td colspan="3" style="text-align:center;color:red;"><?php echo $data['NoRecordsFound'];?></td></tr>
					<?php } ?>
				</tbody>
			</table>
		
		 <?php
		// Return results as json encoded array 
		//echo json_encode($skillData); 
    }
}