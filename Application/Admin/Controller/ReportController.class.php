<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi;
use Think\Controller;
use Admin\Controller\AgentController;

/**
 * 报表控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class ReportController extends AdminController {

    /**
     *  渠道商报表导出
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function agents(){
  
		vendor('PHPExcel.PHPExcel');
		$objExcel = new \PHPExcel(); 
		$objExcel->setActiveSheetIndex(0);  
	
 		$objExcel->getActiveSheet()->setCellValue('A1', '渠道商账号')->getColumnDimension('A')->setWidth(15);
 		$objExcel->getActiveSheet()->setCellValue('B1', '区域')->getColumnDimension('B')->setWidth(10);
 		$objExcel->getActiveSheet()->setCellValue('C1', '类型')->getColumnDimension('C')->setWidth(10);
 		$objExcel->getActiveSheet()->setCellValue('D1', '公司')->getColumnDimension('D')->setWidth(30);
 		$objExcel->getActiveSheet()->setCellValue('E1', '姓名')->getColumnDimension('E')->setWidth(10);
 		$objExcel->getActiveSheet()->setCellValue('F1', '手机号码')->getColumnDimension('F')->setWidth(20);
 		$objExcel->getActiveSheet()->setCellValue('G1', '季度')->getColumnDimension('G')->setWidth(10);
 		$objExcel->getActiveSheet()->setCellValue('H1', '任务(目标金额/提成比例)')->getColumnDimension('H')->setWidth(70);
 		$objExcel->getActiveSheet()->setCellValue('I1', '销售')->getColumnDimension('I')->setWidth(10);
 		$objExcel->getActiveSheet()->setCellValue('J1', '返利')->getColumnDimension('J')->setWidth(10);
 		$objExcel->getActiveSheet()->setCellValue('K1', '达成率')->getColumnDimension('K')->setWidth(10);
        $objExcel->getActiveSheet()->setCellValue('L1', '奖励')->getColumnDimension('L')->setWidth(10);
 		
      	$id = explode(',',I('id'));
		if(!I('id')||empty($id)){
			exit('ss');
		}

 		$map['a.id'] = array('in',$id);
 		$member = D('ucenter_member')
 			->alias('a')
 			->join('robam_member b ON b.uid= a.id')
 			->where($map)
 			->select();

        //导出用户数据 	  
 		foreach ($member as $key => $value) {
 	 		$i = $key*5+2; $j = $i+4;
 	 		//渠道商账号
 		 	$objExcel->getActiveSheet(0)->mergeCells('A'.$i.':'.'A'.$j);
 			$objExcel->getActiveSheet(0)->setCellValue('A'.$i, $value['username']);
 			//区域
 		 	$objExcel->getActiveSheet(0)->mergeCells('B'.$i.':'.'B'.$j);
 			$objExcel->getActiveSheet(0)->setCellValue('B'.$i, $value['area']);
 			//类型
 		 	$objExcel->getActiveSheet(0)->mergeCells('C'.$i.':'.'C'.$j);
 			$objExcel->getActiveSheet(0)->setCellValue('C'.$i, $value['type']);
 			//公司
 		 	$objExcel->getActiveSheet(0)->mergeCells('D'.$i.':'.'D'.$j);
 			$objExcel->getActiveSheet(0)->setCellValue('D'.$i, $value['company']);
 			//姓名
 		 	$objExcel->getActiveSheet(0)->mergeCells('E'.$i.':'.'E'.$j);
 			$objExcel->getActiveSheet(0)->setCellValue('E'.$i, $value['nickname']);
 			//手机号码
 		 	$objExcel->getActiveSheet(0)->mergeCells('F'.$i.':'.'F'.$j);
 			$objExcel->getActiveSheet(0)->setCellValue('F'.$i, $value['mobile']);
 			
            //个人信息统计
 			$agent = new AgentController();
 			$result = $agent->taskDetail($value['id']);
 			//季度
 			$num = 0;
 			for ($k=$i; $k <=$j ; $k++) { 
 				$num++;
 				$msg = seasonDB($num);
 				$objExcel->getActiveSheet(0)->setCellValue('G'.$k, $msg);
 				
 				//任务
 				$objExcel->getActiveSheet(0)->setCellValue('H'.$k, $result[$num]['task']);
 				//销售
 				$objExcel->getActiveSheet(0)->setCellValue('I'.$k, $result[$num]['orders']);
 				//返利
 				$objExcel->getActiveSheet(0)->setCellValue('J'.$k, $result[$num]['rebate']);
 				//达成率
 				$objExcel->getActiveSheet(0)->setCellValue('K'.$k, $result[$num]['reach_rate']);
 				//奖励
 				$objExcel->getActiveSheet(0)->setCellValue('L'.$k, $result[$num]['reward']);
 			}
 			
 		}	

 
 	
		
	 
  
		$filename = "渠道商报表【".date('Y-m-d')."】.xls";  
		$filename = iconv("utf-8", 'gbk', $filename);  
		$objWriter = \PHPExcel_IOFactory::createWriter ( $objExcel, 'Excel5' );  
		header ( 'Content-Type: application/vnd.ms-excel' );  
		header ( "Content-Disposition: attachment;filename=$filename" );  
		header ( 'Cache-Control: max-age=0' );  
		$objWriter->save ( 'php://output' );  
		exit(); 
    }



   
}
