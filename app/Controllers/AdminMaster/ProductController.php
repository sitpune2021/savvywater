<?php
namespace App\Controllers\AdminMaster;
use App\Controllers\BaseController;
use App\Models\AdminMaster\MasterModel;

class MasterController extends BaseController
{
    protected $helpers = ["form","url"];
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $db = db_connect();
        $this->MasterModel = new MasterModel($db);
    }
   
    
    /************ Products Master - Niranjan Kakatkar ****************/
     
    public function Vendor()
    {
        
        $data['all_list'] = $this->MasterModel->getAllData('tbl_vendors');
       
        return view('AdminMaster/Vendor/view',$data);
    }
    public function AddVendor()
    {
        return view('AdminMaster/Vendor/add');
    }
    public function store_Vendor()
    {
        $session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'name'      => 'required',
            'email' => 'required',
            'phone_no' => 'required',
            'website' => 'required',
            'full_address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'bank_name' => 'required',
            'bank_branch' => 'required',
            'holder_name' => 'required',
            'account_no' => 'required',
            'ifsc_code' => 'required'
        ];
        $validationMessages = 
        [
                'name'      => ['required' => 'Please enter Vendor Name.'],
                'email' => ['required' => 'Please enter Email.'],
                'phone_no' => ['required' => 'Please enter Phone number.'],
                'website' => ['required' => 'Please enter Webiste.'],
                'full_address' => ['required' => 'Please enter Full Address.'],
                'country' => ['required' => 'Please enter Country.'],
                'state' => ['required' => 'Please enter State.'],
                'city' => ['required' => 'Please enter City.'],
                'pincode' => ['required' => 'Please enter Pincode.'],
                'bank_name' => ['required' => 'Please enter Bank Name.'],
                'bank_branch' => ['required' => 'Please enter Branch Name.'],
                'holder_name' => ['required' => 'Please enter Holder Name.'],
                'account_no' => ['required' => 'Please enter Account Number.'],
                'ifsc_code' => ['required' => 'Please enter IFSC Code.']
        ];
        if ($this->validate($validationRules, $validationMessages))
        {
            $deptData = $_POST;
            $builder = $db->table('tbl_vendors');
                
            if($editId=='')
            {
                $builder->insert($deptData);
            }else
            {
                $builder->where('id', $editId)->update($deptData);
            }
            return $this->response->redirect(site_url('/Vendor'));
            
        }else
        {
            if(empty($editId))
            {
                return view('AdminMaster/Vendor/add', ['validation' => $validation]);
            }else {
                $list = $this->MasterModel->getData('tbl_vendors',$editId);
                return view('AdminMaster/Vendor/edit', ['validation' => $validation,'list' => $list]);
            }
        }
    }
    public function updateVendor()
    {
        $id = base64_decode($_GET['ID']);
        $data['list'] = $this->MasterModel->getData('tbl_vendors',$id);
        return view('AdminMaster/Vendor/edit',$data);
    }
    public function deleteRec()
    {
        $id     = $_POST['id'];
        $table  = $_POST['table'];
        $db = db_connect('default');
        $dDate = array('isdeleted'	=> 1);
        $builder = $db->table($table);
        $builder->where('id', $id)->update($dDate);
        return true;
    }
    


        /************ Customer Master - Niranjan Kakatkar ****************/
     
        public function Customer()
        {
            $data['all_list'] = $this->MasterModel->getAllData('tbl_customers');
            return view('AdminMaster/Customer/view',$data);
        }
        public function AddCustomer()
        {
            return view('AdminMaster/Customer/add');
        }
        public function store_Customer()
        {
            $session = session();
            $db = db_connect('default');
            $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
            $validation = \Config\Services::validation();
            $validationRules = 
            [
                'name'      => 'required',
                'email' => 'required',
                'phone_no' => 'required',
                'full_address' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'bank_name' => 'required',
                'bank_branch' => 'required',
                'holder_name' => 'required',
                'account_no' => 'required',
                'ifsc_code' => 'required'
            ];
            $validationMessages = 
            [
                    'name'      => ['required' => 'Please enter Customer Name.'],
                    'email' => ['required' => 'Please enter Email.'],
                    'phone_no' => ['required' => 'Please enter Phone number.'],
                    'full_address' => ['required' => 'Please enter Full Address.'],
                    'country' => ['required' => 'Please enter Country.'],
                    'state' => ['required' => 'Please enter State.'],
                    'city' => ['required' => 'Please enter City.'],
                    'pincode' => ['required' => 'Please enter Pincode.'],
                    'bank_name' => ['required' => 'Please enter Bank Name.'],
                    'bank_branch' => ['required' => 'Please enter Branch Name.'],
                    'holder_name' => ['required' => 'Please enter Holder Name.'],
                    'account_no' => ['required' => 'Please enter Account Number.'],
                    'ifsc_code' => ['required' => 'Please enter IFSC Code.']
            ];
            if ($this->validate($validationRules, $validationMessages))
            {
                $deptData = $_POST;
                $builder = $db->table('tbl_customers');
                    
                if($editId=='')
                {
                    $builder->insert($deptData);
                }else
                {
                    $builder->where('id', $editId)->update($deptData);
                }
                return $this->response->redirect(site_url('/Customer'));
                
            }else
            {
                if(empty($editId))
                {
                    return view('AdminMaster/Customer/add', ['validation' => $validation]);
                }else {
                    $list = $this->MasterModel->getData('tbl_customers',$editId);
                    return view('AdminMaster/Customer/edit', ['validation' => $validation,'list' => $list]);
                }
            }
        }
        public function updateCustomer()
        {
            $id = base64_decode($_GET['ID']);
            $data['list'] = $this->MasterModel->getData('tbl_customers',$id);
            return view('AdminMaster/Customer/edit',$data);
        }



    /************ Roles - Niranjan Kakatkar ****************/
     
    public function Role()
    {
        $data['all_list'] = $this->MasterModel->getAllData('tbl_roles');
        return view('Master/Role/view',$data);
    }
    public function AddRole()
    {
        return view('Master/Role/add');
    }
    public function store_role()
    {
        $session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'name'      => 'required'
        ];
        $validationMessages = 
        [
                'name'      => ['required' => 'कृपया भूमिकेचे नाव प्रविष्ट करा.']
        ];
        if ($this->validate($validationRules, $validationMessages))
        {
            $roleData = $_POST;
            $builder = $db->table('tbl_roles');
                
            if($editId=='')
            {
                $builder->insert($roleData);
            }else
            {
                $builder->where('id', $editId)->update($roleData);
            }
            return $this->response->redirect(site_url('/Role'));
            
        }else
        {
            if(empty($editId))
            {
                return view('Master/Role/add', ['validation' => $validation]);
            }else {
                $list = $this->MasterModel->getData('tbl_roles',$editId);
                return view('Master/Role/edit', ['validation' => $validation,'list' => $list]);
            }
        }
    }
    public function updateRole()
    {
        $id = base64_decode($_GET['ID']);
        $data['list'] = $this->MasterModel->getData('tbl_roles',$id);
        return view('Master/Role/edit',$data);
    }
    
    
    
    
     /************ Designation - Niranjan Kakatkar ****************/
     
    public function Designation()
    {
        $data['all_list'] = $this->MasterModel->getAllData('tbl_designations');
        return view('Master/Designation/view',$data);
    }
    public function AddDesignation()
    {
        return view('Master/Designation/add');
    }
    public function store_desig()
    {
        $session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'name'      => 'required'
        ];
        $validationMessages = 
        [
                'name'      => ['required' => 'कृपया आधिकार्याचे नाव प्रविष्ट करा.']
        ];
        if ($this->validate($validationRules, $validationMessages))
        {
            $desigData = $_POST;
            $builder = $db->table('tbl_designations');
                
            if($editId=='')
            {
                $builder->insert($desigData);
            }else
            {
                $builder->where('id', $editId)->update($desigData);
            }
            return $this->response->redirect(site_url('/Designation'));
            
        }else
        {
            if(empty($editId))
            {
                return view('Master/Designation/add', ['validation' => $validation]);
            }else {
                $list = $this->MasterModel->getData('tbl_designations',$editId);
                return view('Master/Designation/edit', ['validation' => $validation,'list' => $list]);
            }
        }
    }
    public function updateDesig()
    {
        $id = base64_decode($_GET['ID']);
        $data['list'] = $this->MasterModel->getData('tbl_designations',$id);
        return view('Master/Designation/edit',$data);
    }
    
    /************ Rejection Reason - Niranjan Kakatkar ****************/
    
    
    public function RejectionReason()
    {
        $data['all_list'] = $this->MasterModel->getAllData('tbl_rejection_reason');
        return view('Master/RejectionReason/view',$data);
    }
    public function AddRejectReason()
    {
        return view('Master/RejectionReason/add');
    }
    public function store_rejection_reason()
    {
        $session = session();
        $db = db_connect('default');
        $editId     = !empty($_POST['id']) ? $_POST['id'] : '';
        $validation = \Config\Services::validation();
        $validationRules = 
        [
            'reason'      => 'required'
        ];
        $validationMessages = 
        [
            'reason'      => ['required' => 'कृपया नकाराचे कारण प्रविष्ट करा.']
        ];
        if ($this->validate($validationRules, $validationMessages))
        {
            $reasonData = $_POST;
            $builder = $db->table('tbl_rejection_reason');
                
            if($editId=='')
            {
                $builder->insert($reasonData);
            }else
            {
                $builder->where('id', $editId)->update($reasonData);
            }
            return $this->response->redirect(site_url('/RejectionReason'));
            
        }else
        {
            if(empty($editId))
            {
                return view('Master/RejectionReason/add', ['validation' => $validation]);
            }else {
                $list = $this->MasterModel->getData('tbl_rejection_reason',$editId);
                return view('Master/RejectionReason/edit', ['validation' => $validation,'list' => $list]);
            }
        }
    }
    public function updateRejectionReason()
    {
        $id = base64_decode($_GET['ID']);
        $data['list'] = $this->MasterModel->getData('tbl_rejection_reason',$id);
        return view('Master/RejectionReason/edit',$data);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    /************ Owner Suggestion Dropdown : Tenant Form - Sagar Chavan****************/
    
    public function suggestionsList()
    {
        $MasterModel = new MasterModel();
        $ownerName  = $_POST['name'];
        $table      = $_POST['table'];
        $field      = $_POST['field'];
        $searchType = !empty($_POST['searchType']) ? $_POST['searchType'] : '';
        $owners = $MasterModel->suggestionsList($ownerName,$table,$field);
        foreach($owners as $row){ ?>
        <li style="list-style: none;" class="sercdata" onclick="searchadd<?=$searchType;?>('<?php echo $row['name'];?>','<?php echo $row['id'];?>')">
            <?php echo  $row['name']; ?></li>
        <?php }
    }
 
}
