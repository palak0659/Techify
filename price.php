<?php
// include 'newheader.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="Dimages/favicon.jpeg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techify</title>
    <style>
        .contain32 {
            font-family: 'Poppins', sans-serif;
            height: 100px;
            background-color: black;
            width: 100%;
        }

        .contain32 .button {
            float: left;
            width: 10%;
            margin-left: 30px;
            margin-top: 15px;
            background-color: black;
        }

        .contain32 .button a {
            background-color: black;
            text-decoration: none;
            font-size: 20px;
            color: #0d6efd
        }

        .contain32 .button a::before {
            content: '<';
            margin-right: 10px;
        }

        .contain32 .heading32 {
            text-align: center;
            float: left;
            width: 35%;
            margin-left: 30px;
            color: burlywood;
            background-color: black;
            font-family: 'Permanent Marker', cursive;
        }

        .contain32 .heading32 p {
            margin-top: 20px;
            font-size: 30px;
            background-color: black;
        }

        .contain32 .heading32 p i {
            margin-right: 10px;
            background-color: black;
        }

        .contain32 .logoT32 {
            float: right;
            width: 40%;
            margin-top: 0px;
            background-color: black;
            /* height: 20%; */
        }

        .logoT32 img {
            height: 100px;
            width: 350px;
            transform: translateY(-5%);
            background-color: black;
        }

        .course-category {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            font-size: x-large;
            font-weight: bolder;
            min-height: 42px;
            background-color: #323131;
            padding: 10px;
        }

        .techfield {
            margin: 10px;
        }

        .techfield a {
            text-decoration: none;
            color: gold;
            border: 2px solid goldenrod;
            border-radius: 8px;
            font-size: 1em;
            padding: 4px;
        }

        .techfield :hover {
            color: goldenrod;
            /* text-decoration: double; */
        }
    </style>
    <!-- google fonts cdn link  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="DCSS/coursecatstyle.css">

</head>

<body>
    <div class="contain32">
        <div class="button">
            <a href="category.php">Go Back</a>
        </div>
        <div class="heading32">
            <?php
                echo '<p><i class="fab fa-leanpub"></i>Enjoy & Learn with us !!</p>';
            ?>
        </div>
        <div class="logoT32">
            <img src="Dimages/T.jpeg">
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">

                    <div class="card-body">

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="input-group mb-3">
                                        <select name="level" class="form-control">
                                            <option value="">--Select Option--</option>
                                            <option value="Below 500" <?php if (isset($_GET['level']) && $_GET['level'] == "Below 500") {
                                                                            echo "selected";
                                                                        } ?>> Below 500</option>
                                            <option value="500-1000" <?php if (isset($_GET['level']) && $_GET['level'] == "500-1000") {
                                                                            echo "selected";
                                                                        } ?>> 500-1000</option>
                                            <option value="Above 1000" <?php if (isset($_GET['level']) && $_GET['level'] == "Above 1000") {
                                                                            echo "selected";
                                                                        } ?>> Above 1000</option>
                                        </select>
                                        <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">
                                            Price
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

</body>
<section class="course" id="course">
    <div class="box-container">
        <?php
        include "config.php";

        $s = '<500';
        if (isset($_GET['level'])) {
            if ($_GET['level'] == "Below 500") {
                $s = '<500';
            } elseif ($_GET['level'] == "500-1000") {
                $s = 'BETWEEN 500 AND 1000';
            } elseif ($_GET['level'] == "Above 1000") {
                $s = '>=1000';
            }
        }

        $sql = "SELECT * FROM itcourses
                        WHERE itcourses.Price $s ";


        $result = mysqli_query($conn, $sql) or die("Query Failed.");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

        ?>

                <div class="box">

                    <img src="admin/upload/<?php echo $row['course_img']; ?>" alt="">
                    <h3 class="price"> <?php echo $row['Price']; ?></h3>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                        </div>
                        <a href='coursedetail.php?id=<?php echo $row['Course_id']; ?>' class="title"><?php echo $row['Course_Name']; ?></a>
                        <p><?php echo $row['Description']; ?></p>
                        <div class="info">
                            <h3> <i class="far fa-clock"></i><?php echo $row['Time']; ?> Hrs </h3>
                            <h3> <i class="far fa-calendar-alt"></i> <?php echo $row['Duration']; ?> Months </h3>
                            <h3> <i class="fas fa-book"></i> <?php echo $row['Modules']; ?> Modules </h3>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<h2>No Record Found.</h2>";
        }
        ?>


    </div>

</section>


<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>

</html>