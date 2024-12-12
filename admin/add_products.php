<?php
session_start();
include("../../db.php");

if(isset($_POST['btn_save']))
{
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $product_type = $_POST['product_type'];

    // Picture handling
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    // Check if an image file was uploaded
    if($picture_name != "")
    {
        if($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif")
        {
            if($picture_size <= 50000000) // Check file size
            {
                $pic_name = time()."_".$picture_name; // Rename the file with a timestamp
                move_uploaded_file($picture_tmp_name, "../../product_images/".$pic_name); // Save the file in the directory

                // Insert into the database
                mysqli_query($con, "INSERT INTO products (product_cat, product_title, product_price, product_image) 
                                    VALUES ('$product_type', '$product_name', '$price', '$pic_name')") 
                                    or die ("Query incorrect");
                header("location: sumit_form.php?success=1");
            }
            else
            {
                echo "Image size should be less than 50MB";
            }
        }
        else
        {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }
    else
    {
        echo "Please upload an image.";
    }

    mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" name="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Add Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Title</label>
                                        <input type="text" id="product_name" required name="product_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Add Image</label>
                                        <input type="file" name="picture" required class="btn btn-fill btn-success" id="picture">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pricing</label>
                                        <input type="text" id="price" name="price" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Categories</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Category</label>
                                        <input type="number" id="product_type" name="product_type" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Add Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include "footer.php";
?>
