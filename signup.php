<?php
include_once("includes/dbconn.php");

$centers=[];
$Doctor_ID='';
$email_error=null;
$firstname_error=null;
$secondname_error=null;
$passerror=null;
$nationalId=NULL;
$PPhone_Number_error=null;
$dob_error=null;
$repass_error=null;

$PFirst_Name=null;
$PLast_Name=null;
$PEmail=null;
$PPassword=null;
$PNational_ID=null;
$PPhone_Number=null;
$Medicine=null;
$Allergy_type=null;


if(isset($_POST) ){
// $Doctor_ID=$_POST['Doctor_ID'];
// $PFirst_Name=$_POST['PFirst_Name'];
// $PLast_Name=$_POST['PLast_Name'];
// $PEmail=$_POST['PEmail'];
// $PPassword=$_POST['PPassword'];
// $PNational_ID=$_POST['PNational_ID'];
// $PPhone_Number=$_POST['PPhone_Number'];
// $pregion=$_POST['pregion'];
// $PDOB=$_POST['PDOB'];
// $Gender=$_POST['Gender'];
// $Blood_Type=$_POST['Blood_Type'];

// $Pcity=$_POST['Pcity'];
// $Medicine=$_POST['Medicine'];

// $smoker=$_POST['smoker'];
// $Allergy_type=$_POST['Allergy_type'];
// $repass=$_POST['repass'];

//did 
if(isset($_POST['center'])){
  $center=$_POST['center'];
  }
//end did

//gender
if(isset($_POST['Gender'])){
  $Gender=$_POST['Gender'];
  }

//end gender

if(isset($_POST['Blood_Type'])){
  $Blood_Type=$_POST['Blood_Type'];
  }

  if(isset($_POST['Pcity'])){
    $Pcity=$_POST['Pcity'];
    }

    if(isset($_POST['Medicine'])){
      $Medicine=$_POST['Medicine'];
      }

      if(isset($_POST['smoker'])){
        $smoker=$_POST['smoker'];
        }

        if(isset($_POST['Allergy_type'])){
          $Allergy_type=$_POST['Allergy_type'];
          }
//region

if(isset($_POST['pregion'])){
$pregion=$_POST['pregion'];
}
     
 //end region
 

  //fun
  
  function isArabicName( $patientFName) {
              
    $pattern = '/^[اأإآبتثجحخدذرزسشصضطظعغفقكلمنهويـ ]{2,50}$/u';

    return preg_match($pattern, $patientFName) === 1;
  }
  //end fun
  
  
  //fname
  
       if (isset($_POST['PFirst_Name'])) {
        $PFirst_Name=$_POST['PFirst_Name'];
       
      if (!preg_match('/^[\p{Arabic}\s]+$/u',$PFirst_Name)) {
     
       $firstname_error="الرجاء ادخال اسمك باللغة العربية";
         isArabicName( $PFirst_Name) ;
          
        }
      }
      //end fname

      //sname
  if (isset($_POST['PLast_Name'])) {
    $PLast_Name=$_POST['PLast_Name'];
    
      if (!preg_match('/^[\p{Arabic}\s]+$/u', $PLast_Name)) {
        
        $secondname_error='الرجاء ادخال اسمك باللغة العربية';
        isArabicName($PLast_Name );
      }}
      //end sname


  //id num
      if (isset($_POST['PNational_ID'])) {
        $PNational_ID=$_POST['PNational_ID'];
        
        if (!preg_match('/^\d{10}$/', $PNational_ID)) {
         
          $nationalId="الرقم الذي تم ادخاله غير صالح";
        }
     
      } //id end
    
  
     //dob
      if (isset($_POST['PDOB'])) {
        $PDOB=$_POST['PDOB'];
        
        $dobDateTime = new DateTime($PDOB);
    
       
        $yearOfBirth = (int)$dobDateTime->format('Y');
    
       
        $currentYear = (int)date("Y");
        if (!is_numeric($yearOfBirth) || $yearOfBirth < 1930 || $yearOfBirth > $currentYear) {
            $dob_error = "تاريخ ميلادك غير صحيح";
        }
    }
    //end dob
   
  //email
        if (isset($_POST['PEmail'])) {
          $PEmail=$_POST['PEmail'];
          $email_pattern = '/^[a-zA-Z0-9._\-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

          if (!preg_match($email_pattern, $PEmail)) {
             
              $email_error = "الرجاء ادخال بريدك الالكتروني بالطريقة الصحيحة";
          }
      }
      //end email

      //pphone
      
    if (isset($_POST['PPhone_Number'])) {
      $PPhone_Number=$_POST['PPhone_Number'];
      if (!preg_match('/^07[0-9]{8}$/',$PPhone_Number)) {
      
          $PPhone_Number_error="الرجاء ادخال رقم هاتفك بالطريقة الصحيحة";
      }
  }
  //end pphone

  //pass
  if (isset($_POST['PPassword'])) {
    
    $PPassword=$_POST['PPassword'];
    $password_hash = password_hash($_POST["PPassword"], PASSWORD_DEFAULT);
    
    if (strlen($PPassword) < 8) {
       
        $passerror="كلمة المرور يجب أن تكون على الأقل 8 أحرف";
    } elseif (!preg_match('/[A-Za-z]/', $PPassword) || !preg_match('/\d/', $PPassword)) {
       
        $passerror="كلمة المرور يجب أن تكون على الأقل 8 أحرف";
    }
  }
  //end pass
  //repass
  if(isset($_POST['repass'])){
    $repass=$_POST['repass'];
    if($PPassword!=$repass){
      $repass_error="يجب اعادة ادخال كلمة المرور ";
    }
  }
} if(isset($_POST['submit'])){
  $query="select * from patient where PEmail='$PEmail' or PNational_ID='$PNational_ID' ";
  $result=mysqli_query($conn,$query);
  if (mysqli_num_rows($result) == 0){
  if (empty($email_error) && empty($firstname_error) && empty($secondname_error) && empty($passerror)
  && empty($nationalId) && empty($PPhone_Number_error) && empty($dob_error) && empty($repass_error)) {
 
$query="SELECT doctor.DID, doctor.center AS doctor_center, COUNT(patient.PID) AS patient_count
FROM doctor
LEFT JOIN patient ON doctor.DID = patient.Doctor_ID
GROUP BY doctor.center, doctor.DID
ORDER BY patient_count ASC
LIMIT 1
";
$result=mysqli_query($conn, $query);
if ($result) {
  $row = mysqli_fetch_assoc($result);
  $Doctor_ID=$row['DID'];
}


  $query="INSERT INTO `patient`(`Doctor_ID`, `PFirst_Name`, `PLast_Name`, `PEmail`, `PPassword`, `PNational_ID`, `PPhone_Number`, `pregion`, `PDOB`, `Gender`, `Blood_Type`, `Pcity`, `Medicine`, `smoker`, `Allergy_type`, `status1`,`center`) VALUES
  ('$Doctor_ID','$PFirst_Name','$PLast_Name','$PEmail',' $password_hash','$PNational_ID','$PPhone_Number','$pregion','$PDOB','$Gender','$Blood_Type','$Pcity','$Medicine','$smoker','$Allergy_type','1','$center')";
 
  mysqli_query($conn, $query);

  echo "<script>alert('لقد تم انشاء حسابك بنجاح');</script>";
  echo "<script> window.location.href='login.php';</script>";
  }
}}else{
  echo "<script>alert('تحقق من رقمك الوطني و بريدك الالكتروني احدهما او كلاهما قيد الاستخدام ');</script>";
}


 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/stylesignup.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title> فتح الحساب</title>
  
</head>
<body>

<div class="center" style="margin-top:65px;">



      <h1> بيانات المريض الشخصية </h1>
      <br>
      <form method="POST" action="" class="form" >
        <div class="txt_field" style=" padding: 20px;">
          <h2>معلومات الشخصية
            <hr>
          </h2>
          <i class="fas fa-user"></i>
          <label> اسم الاول :</label>
<input type="text" name="PFirst_Name" value="<?php echo $PFirst_Name; ?>" required>
<span style="color: red">
    <?php if (($firstname_error)!==null){
        echo  $firstname_error ;
    } ?>
</span>

          <span></span>
          <i class="fas fa-user"></i>
          <label>اسم العائلة :</label>
          <input type="text" name="PLast_Name"  value="<?php  echo $PLast_Name;?>" required>
          <span style="color: red">
    <?php if (($secondname_error)!==null){
        echo  $secondname_error;
    } ?>
</span>
         
          <span></span>
        </div>
        <div class="txt_field" style=" padding: 20px;">
          <i class="fas fa-id-card"></i>
          <label> رقم الوطني:</label>
          <input type="text" id="nationalID" name="PNational_ID"  value="<?php  echo $PNational_ID;?>" maxlength="10">
          <span style="color: red">
    <?php if (($nationalId)!==null){
        echo  $nationalId;
    } ?>
</span>
        </div>
        <div id="gender" style=" padding: 20px;">
          <label> الجنس:</label>
          <label>
            <input type="radio" name="Gender" value="ذكر" required>
            ذكر
          </label>
      
          <label>
            <input type="radio" name="Gender" value="أنثى" required>
            أنثى
          </label>
        </div>
        <div style=" padding: 20px;">
          <label for="birthdaytime">تاريخ الميلاد :</label>
          <input type="date" id="birthdaytime" name="PDOB" value="<?php  echo $PDOB ;?>">
          <span style="color: red">
    <?php if (($dob_error)!==null){
        echo  $dob_error;
    } ?>
</span>
        
        </div>

        <div class="txt_field">
          <i class="fas fa-envelope"></i>
          <label for="email">البريد الإلكتروني:</label>
          <input type="email" id="email" name="PEmail" placeholder="example@example.com"  value="<?php  echo $PEmail;?>">
          <span style="color: red">
    <?php if (($email_error)!==null){
        echo  $email_error;
    } ?>
</span>
          
        </div>
        <div class="txt_field" style=" padding: 20px;">
          <label for="password">كلمة المرور: </label>
          <input type="password" id="password" name="PPassword" placeholder="يرجى ادخال كلمة المرور">
          <span style="color: red">
    <?php if (($passerror)!==null){
        echo  $passerror;
    } ?>
</span>
        

          <label for="check_password">إعادة كلمة المرور:</label>
          <input type="password" id="check_password" name="repass"  placeholder="يرجى اعادة ادخال كلمة المرور">
          <span style="color: red">
          <?php if (($repass_error)!==null){
        echo  $repass_error;
    } ?>
</span>
        </div>



        <div class="txt_field" style=" padding: 20px;">
          <i class="fa fa-phone"></i>
          <label for="phone">رقم الهاتف:</label>
          <input type="tel" min="0" max="9" id="phone" name="PPhone_Number" placeholder='Phone: (xxx) - xxx xxxx'  value="<?php  echo $PPhone_Number;?>" required>
          <span style="color: red">
          <?php if (($PPhone_Number_error)!==null){
        echo  $PPhone_Number_error;
    } ?>

</span>
         
        </div>

        <div>
          <br>

          <h2>معلومات الصحية
            <hr>
          </h2>

          <label> الادوية:</label>

          <div class="form-container">
            <input type="text"  name="Medicine" placeholder="أدخل اسم الدواء" style=" width: 70%;"  value="<?php  echo $Medicine;?>">
           
          </div>
       
          <span>
            <label> زمرة الدم:</label>
            <select class='' id='blood' name="Blood_Type" placeholder='bloodtype'>
              <option>A+</option>
              <option>A-</option>
              <option>B+</option>
              <option>B-</option>
              <option>AB+</option>
              <option>AB-</option>
              <option>O+</option>
              <option>O-</option>
            </select> </span>
            <br>
            <div id="smoker" >
              <label> هل انت مدخن ؟</label>
            <label>
              <input type="radio" name="smoker" value="نعم" required >
              نعم
            </label>
          
            <label>
              <input type="radio" name="smoker" value="لا" required>
              لا
            </label>
          </div>
        </div>
        <br>
        <div id="allergy">
          <label> نوع الحساسية:</label>
          <div class="form-container">
            <input type="text"  name="Allergy_type" style=" width: 70%;"  value="<?php  echo $Allergy_type;?>">
           
          </div>
          </div>
       
       
        <div>
        <br> 
        <h2>مكان السكن
     
            <hr>
          </h2>
          <br>  <br>
          
          <div style="display: flex; ">
  <div>
    <label id="governorate-label" for="region">اسم المحافظة:</label>
    <select id="governorate" name="Pcity" required>
      <option value="الرجاء اختيار محافظتك " disabled selected>الرجاء اختيار محافظتك</option>
      <option value="amman">عمان</option>
                <option value="irbid">إربد</option>
                <option value="zarqa">الزرقاء</option>
                <option value="Madaba">مادبا</option>
                <option value="Karak">الكرك</option>
                <option value="Tafilah">الطفيلة</option>
                <option value="Maan">معان</option>
                <option value="Aqaba">العقبة</option>
                <option value="Jerash">جرش</option>
                <option value="Mafraq">المفرق</option>
                <option value="Balqa">البلقاء</option>
                <option value="Ajloun">عجلون</option>
                </select>
  </div>
  <div id="region-container">
    <label for="region">اسم منطقة:</label>
    <select id="region" name="pregion" required>
      <option value="الرجاء اختيار منطقتك السكنية " disabled selected>الرجاء اختيار منطقتك السكنية</option>
     
              </select>
            </div>
            <span>
              <div>
            <label>  اسم المركز:</label>
            <select class='' id='cen' name="center" placeholder='المركز' required>
            <option value="الرجاء اختيار اسم المركز" disabled selected>الرجاء اختيار اسم المركز</option>

             
            
            </select> </span>
         
          </div>
          </div>
          <div class="container">
            <input type="submit" name="submit" value="حفظ" class="save"
              style="font-size: 20px; margin: 15px; padding:5px;" />
          </div>


        </div>
 
      </form>
      <script>
  const governorateSelect = document.getElementById('governorate');
  const regionSelect = document.getElementById('region');
  const centerSelect = document.getElementById('cen');

  const regionsByGovernorate = {
    amman: ["أبو علندا", "أبو نصير", "أم الحيران", "الجيزة", "الذراع الغربي", "القويسمة", "الشميساني", "المقابلين ",
            "النصر", "المدينة", "تلاع العلي ", "جبل النزهة ", "الموقر", "المهاجرين", "شفا بدران", "صويلح", "ضاحية الأمير حسن",
            "طارق", "ضاحية الياسمين ", "راس العين", "ماركا", "مرج الحمام", "وادي السير", "وادي صقرة", "وادي عبدون", "وسط البلد"],
          irbid: ["المزار الشمالي ", " الرمثا", " الحصن", "سما الروسان ", "دير أبي سعيد ", " الشونة الشمالية", "الطيبة ", " كفر أسد"],
          zarqa: ["الزرقاء الجديدة", "حي الأمير محمد", "حي الفلاح", "حي الأميرة هيا", "حي الزواهرة ", "جبل الأمير حسن", "حي الأمير علي", "حي الجندي", "مدينة المجد", "حي الحسين", "حي الأمير عبد الله", "حي المصفاة"
            , "حي ابن سينا", "ياجوز", "حي جبر", "حي معصوم", "حي رمزي", "حي الأمير حمزة", "حي الأميرة رحمة "],
          Madaba: ["الفيصلية", "ماعين ", "المنشية", "الوسيه", "جرينة", "غرناطة", "المريجمات", "الحوية"],
          Karak: ["الكرك", "المرج", "الثنية", "زحوم", "العدنانية", "الغوير", "بتير", "زيد بن حارثة", "الشهابية", "ادر", "راكين", "منطقة الجديدة"],
          Tafilah: ["القادسية", "الشراه", "الرشادية", "الحسينية", "أبو بنا ", "العيص", "عي", "الخصيبة ", "الصالحية", "النويعمة"],
          Maan: ["المنشية", "المحمدية", "الطميعة", "الصدقة", "الحسينية", "الجرباء الكبيرة", "الجرباء الصغيرة", "الأشعري"],
          Aqaba: ["القويرة", " الديسة", "قريقرة", "فينان", "العسلية", "العباسية", "الحميمة", "الراشدية", "قطر", "رحمة", "وادي عربة"],
          Jerash: ["سوم", "ساكب", "مخيبلة", "الزبقين", "دبين", "حجلة", "عبين", " بيت يرا", "عين جنا"],
          Mafraq: ["الرويشد", "الشيدية", "حويرة", "الشونة", "الشجرة", "غيابة", "سكرة", "الحدباء", "مخيم الازرق"],
          Balqa: ["السلط", "دير علا", "مدينة البلقاء", "الباقورة", "السموع", "الفحيص", "عين الباشا", "الشونة الشمالية", "الشونة الجنوبية"],
          Ajloun: ["كفرنجة", "رأس منيف", "حي", "كفرناحوم", "الراجف"],
       
  };

  governorateSelect.addEventListener('change', () => {
    const selectedGovernorate = governorateSelect.value;
    regionSelect.innerHTML = '<option value="none">الرجاء اختيار منطقتك السكنية</option>';

    if (selectedGovernorate !== 'none' && regionsByGovernorate[selectedGovernorate]) {
      regionsByGovernorate[selectedGovernorate].forEach((region) => {
        const option = document.createElement('option');
        option.value = region;
        option.textContent = region;
        regionSelect.appendChild(option);
      });
    }
  });

  const gov_select = document.getElementById('governorate');
  const reg_container = document.getElementById('region-container');
  const reg_select = document.getElementById('region');
  gov_select.addEventListener('change', function () {
    if (gov_select.value) {
      reg_container.style.display = 'block';
    } else {
      reg_container.style.display = 'none';
    }
  });

  regionSelect.addEventListener('change', () => {
    const selectedRegion = regionSelect.value;

   
    if (selectedRegion !== 'none') {
     
      $.ajax({
        url: 'fetch_centers.php', 
        type: 'POST',
        data: { region: selectedRegion },
        success: function (data) {
         
          centerSelect.innerHTML = data;
        },
        error: function (error) {
          console.error('Error fetching centers:', error);
        }
      });
    }
  });
</script>
      
 
</body>
</html>
