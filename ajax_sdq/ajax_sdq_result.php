<?php

include '../dbconfig.php';

$sql ="SELECT NO01,NO02,NO03,NO04,NO05,NO06,NO07,NO08,NO09,NO10,
NO11,NO12,NO13,NO14,NO15,NO16,NO17,NO18,NO19,NO20,NO21,NO22,NO23,
NO24,NO25 FROM sdq
WHERE student_id = 'S00003' AND class_id ='32'
AND type = 'คุณครู'";

$result = mysqli_query($conn, $sql);

$teacher_arr = array();
while($row = mysqli_fetch_assoc($result))
{
    foreach($row as $key => $value)
    {
        if($value == 0 ){
            $txt = "ไม่จริง";
        }else if($value == 1 ){
            $txt = "ค่อนข้างจริง";
        }else if($value == 2 ){
            $txt = "จริง";
        }

        echo $txt.'<br>';
        $teacher_arr[$key][0] = $value;
        $teacher_arr[$key][1] = $txt;
    }
}

print_r($teacher_arr);
?>

<table class="table table-bordered table-hover" style="width:100%">
                                        <thead class="table-success">
                                            <tr>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">ข้อ</th>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">รายการ</th>
                                                <th scope="col"  colspan="2" class="text-center">คุณครู</th>
                                                <th scope="col"  colspan="2" class="text-center">ผู้ปกครอง</th>
                                            </tr>
                                            <tr>
                                            <th scope="col"  class="text-center">ประเมิน</th>
                                                <th scope="col"   class="text-center">คะแนน</th>
                                                <th scope="col"  class="text-center">ประเมิน</th>
                                                <th scope="col"   class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">1</th>
                                                <td>มักจะบ่นว่าปวดศีรษะ ปวดท้อง</td>
                                                <td class="text-center">
                                                   
                                                </td>
                                                <td class="text-center">
                                                   
                                                </td>
                                                <td class="text-center">
                                                   
                                                </td>
                                                <td class="text-center">
                                                   
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">2</th>
                                                <td>กังวลใจหลายเรื่อง ดูกังวลเสมอ </td>
                                                <td class="text-center">
                                                   
                                                </td>
                                                <td class="text-center">
                                                    
                                                </td>
                                                <td class="text-center">
                                                   
                                                </td>
                                                <td class="text-center">
                                                 
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">3</th>
                                                <td>ดูไม่มีความสุข ท้อแท้</td>
                                                <td class="text-center">
                                                </td>
                                                <td class="text-center">
                                                </td>
                                                <td class="text-center">
                                                </td>
                                                <td class="text-center">
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">4</th>
                                                <td>เครียดไม่ยอมห่างเวลาอยู่ในสถานการณ์ที่ไม่คุ้นและขาดความมั่นใจในตนเอง</td>
                                                <td class="text-center">
                                                   
                                                </td>
                                                <td class="text-center">
                                                    
                                                </td>
                                                <td class="text-center">
                                                   
                                                </td>
                                                <td class="text-center">
                                                 
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">5</th>
                                                <td>ขี้กลัว รู้สึกหวาดกลัวได้ง่าย </td>
                                                <td class="text-center">
                                                  
                                                </td>
                                                <td class="text-center">
                                                 
                                                </td>
                                                <td class="text-center">
                                                 
                                                </td>
                                                <td class="text-center">
                                                   
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>