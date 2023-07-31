<!DOCTYPE html>
<html>

<head>
    <title>Resident Information Form</title>
</head>

<body>
    <!-- Main Content -->
    <div id="content">
        <div class="container">
            <br>
            <br>
            <br>
            <h2 class="text-center">EDIT RBI</h2>
            <?php
if(isset($_SESSION['error'])):?>
	<div style="color:red;"><?= $_SESSION['error'] ?></div>
<?php endif;?>
            <br>
            <br>

            <form action="<?php echo base_url('index.php/dashboard/update-rbi/'.$rbi_data->id); ?>" method="POST" >
                <div class="form-row">
                    <div class="form-group col">
                        <label for="firstname">First Name:</label>
                        <input value="<?php echo $rbi_data->first_name; ?>" type="text" name="firstname" id="firstname" class="form-control" required />
                        <span><?= form_error('firstname') ?></span>
                    </div>
                    <br>
                    <div class="form-group col">
                        <label for="middlename">Middle Name:</label>
                        <input type="text" value="<?php echo $rbi_data->middle_name; ?>" name="middlename" id="middlename" class="form-control" required />
                        <span><?= form_error('middlename') ?></span>
                    </div>
                    <br>
                    <div class="form-group col">
                        <label for="lastname">Last Name:</label>
                        <input type="text" value="<?php echo $rbi_data->last_name; ?>" name="lastname" id="lastname" class="form-control" required />
                        <span><?= form_error('lastname') ?></span>
                    </div>
                    <br>
                    <div class="form-group col">
                        <label for="extname">Extension Name:</label>
                            <select value="<?php echo $rbi_data->extname; ?>" name="extname" id="extname" class="form-control">
                            <option value=""></option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option> <!-- Add more options as needed -->
                            </select>
                        <span><?= form_error('extname') ?></span>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="purok">Purok:</label>
                        <select value="<?php echo $rbi_data->purok; ?>" name="purok" id="purok" class="form-control" required>
                            <?php for ($i = 1; $i <= 7; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                        <span><?= form_error('purok') ?></span>
                    </div>
                    <br>
                    <div class="form-group col">
                        <label for="street">Street Name:</label>
                        <input type="text" value="<?php echo $rbi_data->streetname; ?>" name="streetname" id="street" class="form-control" required />
                        <span><?= form_error('street') ?></span>
                    </div>
                    <br>
                   
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="sex">Sex:</label>
                        <select value="<?php echo $rbi_data->sex; ?>" name="sex" id="sex" class="form-control" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span><?= form_error('sex') ?></span>
                    </div>
                    <br>
                    <div class="form-group col">
                        <label for="birth_date">Birth Date:</label>
                        <input type="date" value="<?php echo $rbi_data->birth_date; ?>" name="birth_date" id="birth_date" class="form-control" required />
                        <span><?= form_error('birth_date') ?></span>
                    </div>
                    <br>
                    <div class="form-group col">
                        <label for="birth_place">Birth Place:</label>
                        <input type="text" name="birth_place" value="<?php echo $rbi_data->birth_place; ?>" id="birth_place" class="form-control" required />
                        <span><?= form_error('birth_place') ?></span>
                    </div>
                </div>
                <br>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="nationality">Citizenship:</label>
                        <input type="text" value="<?php echo $rbi_data->nationality; ?>" name="nationality" id="nationality" class="form-control" required />
                        <span><?= form_error('nationality') ?></span>
                    </div>
                    <div class="form-group col">
                        <label for="civil_status">Civil Status:</label>
                        <select name="civil_status" value="<?php echo $rbi_data->civil_status; ?>" id="civil_status" class="form-control" required>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                        <span><?= form_error('civil_status') ?></span>
                    </div>
    
                </div>
                <br>

             

                <div class="form-row">
        
                    <div class="form-group col">
                        <label for="contact">Contact:</label>
                        <input type="text" value="<?php echo $rbi_data->contact; ?>" name="contact" id="contact" class="form-control" required />
                        <span><?= form_error('contact') ?></span>
                    </div>
                    <br>
                </div>
                <br>

                <div class="form-row">
                   
                </div>
                <br>

                <div class="form-row">
                  
                </div>
                <br>

                <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Save</button>
                  
                </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

</body>

</html>
