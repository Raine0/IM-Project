<?php
include "../db-conn.php";
?>

<!DOCTYPE html>
<!-- Coding by CodingNepal || www.codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Inventory Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet" href="../style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="logo_item">
            <i class="bx bx-menu" id="sidebarOpen"></i>
            <img src="../3.jpg" alt=""></i>Computer Shop Inventory
        </div>

        <div class="search_bar">
            <input type="text" placeholder="Search" />
        </div>

        <div class="navbar_content">
            <i class="bi bi-grid"></i>
            <i class='bx bx-sun' id="darkLight"></i>
            <i class='bx bx-bell'></i>
            <img src="../icon.jpg" alt="" class="profile" />
        </div>
    </nav>

    <!-- sidebar -->
    <nav class="sidebar">
        <div class="menu_content">
            <ul class="menu_items">
                <div class="menu_title menu_editor"></div>
                <!-- duplicate these li tag if you want to add or remove navlink only -->
                <li class="item">
                    <a href="../Dashboard/dashboard.php" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bi bi-display"></i>
                        </span>
                        <span class="navlink">Dashboard</span>
                    </a>
                </li>
                <!-- Start -->
                <li class="item">
                    <a href="../Products/products.php" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-cart-alt"></i>
                        </span>
                        <span class="navlink">Products</span>
                    </a>
                </li>
                <!-- End -->
                <li class="item">
                    <a href="../Purchases/purchases.php" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bxs-purchase-tag-alt"></i>
                        </span>
                        <span class="navlink">Purchases</span>
                    </a>
                </li>
                <li class="item">
                    <a href="../Sales/sales.php" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bxs-report"></i>
                        </span>
                        <span class="navlink">Sales</span>
                    </a>
                </li>
                <li class="item">
                    <a href="../Suppliers/suppliers.php" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-archive"></i>
                        </span>
                        <span class="navlink">Suppliers</span>
                    </a>
                </li>
                <li class="item">
                    <a href="../Customers/customers.php" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-user-circle"></i>
                        </span>
                        <span class="navlink">Customers</span>
                    </a>
                </li>
                <li class="item">
                    <a href="../User/user.php" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bx bxs-user"></i>
                    </span>
                    <span class="navlink">Users</span>
                    </a>
                </li>
            </ul>
            <ul class="menu_items">
                <div class="menu_title menu_setting"></div>
                    <li class="item">
                        <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-cog"></i>
                        </span>
                        <span class="navlink">Settings</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-layer"></i>
                        </span>
                        <span class="navlink">Features</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="../Login/login.html" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-log-out-circle"></i>
                        </span>
                        <span class="navlink">Logout</span>
                        </a>
                    </li>
            </ul>

            <!-- Sidebar Open / Close -->
            <div class="bottom_content">
                <div class="bottom expand_sidebar">
                    <span> Expand</span>
                    <i class='bx bx-log-in'></i>
                </div>
                <div class="bottom collapse_sidebar">
                    <span> Collapse</span>
                    <i class='bx bx-log-out'></i>
                </div>
            </div>
        </div>
    </nav>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add a Sale</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="productID" class="form-label">Product_ID</label>
              <input type="text" class="form-control" id="productID" placeholder="Enter product ID">
            </div>
            <div class="mb-3">
              <label for="customerID" class="form-label">Customer_ID</label>
              <input type="text" class="form-control" id="customerID" placeholder="Enter the customer ID">
            </div>
            <div class="mb-3">
              <label for="userID" class="form-label">User_ID</label>
              <input type="text" class="form-control" id="userID" placeholder="Enter the user ID">
            </div>
            <div class="mb-3">
              <label for="salesDate" class="form-label">Date of Sale</label>
              <input type="datetime-local" class="form-control" id="salesDate" placeholder="Enter the date">
            </div>
            <div class="mb-3">
              <label for="salesQuantity" class="form-label">Quantity Sold</label>
              <input type="text" class="form-control" id="salesQuantity" placeholder="Enter the quantity">
            </div>
            <div class="modal-body">
                  <h4 style="text-align: center; font-size: 17px;">
                      The price per unit will automatically filled based on products table.
                  </h4>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" onclick="addsales()">Submit</button>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update a Sale</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="editProduct" class="form-label">Product_ID</label>
              <input type="text" class="form-control" id="editProduct" placeholder="Enter product ID">
            </div>
            <div class="mb-3">
              <label for="editCustomer" class="form-label">Customer_ID</label>
              <input type="text" class="form-control" id="editCustomer" placeholder="Enter the customer ID">
            </div>
            <div class="mb-3">
              <label for="editUser" class="form-label">User_ID</label>
              <input type="text" class="form-control" id="editUser" placeholder="Enter the user ID">
            </div>
            <div class="mb-3">
              <label for="editDate" class="form-label">Date of Sale</label>
              <input type="datetime-local" class="form-control" id="editDate" placeholder="Enter the date">
            </div>
            <div class="mb-3">
              <label for="editQuantity" class="form-label">Quantity Sold</label>
              <input type="text" class="form-control" id="editQuantity" placeholder="Enter the quantity">
            </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" id="update_data_btn">Submit</button>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post">
              <input type="hidden" name="product_id" id="product_id">
              <div class="modal-body">
                  <h4 style="text-align : center; font-size: 20px;">
                      Are you sure you want to delete this data?
                  </h4>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="delete_data_btn">Delete</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
              </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Table -->
    <div class="table-wrapper">
        <div class="container my-3">
            <h2 class="text-center" style="margin-left: 185px;">Sales</h2>
            <button type="button" id="blueButton" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createModal">
            Add New
            </button>
        </div>
        <table>
            <tr id="header">
                <th>Sales_ID</th>
                <th>Product_ID</th>
                <th>Customer_ID</th>
                <th>User_ID</th>
                <th>Date of Sale</th>
                <th>Quantity Sold</th>
                <th>Price per Unit</th>
                <th>Total Revenue</th>
                <th>Action</th>
            </tr>
            <tbody>
                <?php
            $sql = "SELECT * FROM `Sales`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td class="sales_id"><?php echo $row["sales_ID"] ?></td>
                    <td><?php echo $row["product_ID"] ?></td>
                    <td><?php echo $row["customer_ID"] ?></td>
                    <td><?php echo $row["User_id"] ?></td>
                    <td><?php echo $row["date_of_sale"] ?></td>
                    <td><?php echo $row["quantity_sold"] ?></td>
                    <td><?php echo '₱' . $row["price_per_unit"] ?></td>
                    <td><?php echo '₱' . $row["total_revenue"] ?></td>
                    <td>
                        <a href="#" class="link-dark update_button"><i class="bi bi-pencil-square"></i></a>
                        <a href="#" class="link-dark delete_button"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript -->
    <script src="../script.js"></script>

    <!-- Bootstrap Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // create
        function addsales(){
            var productAdd=$('#productID').val();
            var customerAdd=$('#customerID').val();
            var userAdd=$('#userID').val();
            var dateAdd = $('#salesDate').val().replace('T', ' '); // Replace 'T' with a space
            dateAdd += ':00'; // Add ':00' at the end
            var quantityAdd=$('#salesQuantity').val();
            

            $.ajax({
            url:"insert_sales.php",
            type:'post',
            data:{
                productSend: productAdd,
                customerSend: customerAdd,
                userSend: userAdd,
                dateSend: dateAdd,
                quantitySend: quantityAdd
                
            },
            success:function(data,status){
                // function to display data
                console.log(status);

                // close create modal
                // $('#createModal').modal('hide'); 

                // Reload the page
                location.reload();
            }
            })
        }

        // delete icon from table
        $('.delete_button').click(function (e) {
            e.preventDefault();

            var id = $(this).closest('tr').find('.sales_id').text();
            console.log(id);
            $('#sales_id').val(id);
            $('#deleteModal').modal('show');

            // confirm delete button
            $('#delete_data_btn').off().on('click', function (e) {
                e.preventDefault();
            
                $.ajax({
                    method: "POST",
                    url: "delete_sales.php",
                    data: {
                        'delete_data_btn': true,
                        'sales_id': id,
                    },
                    success: function (response) {
                        console.log(response);
                        // Perform any additional actions after successful deletion
                        // Perform UI update after successful deletion
                        if (response === 'successful') {
                            // Update the UI, such as removing the deleted row from a table
                            $('td.sales_id').filter(function () {
                                return $(this).text() === id;
                            }).closest('tr').remove();
                        }
                    }
                });

                // Optionally, you can close the modal after clicking the delete button
                $('#deleteModal').modal('hide');
            });
        });
        
        // update icon from table
        $(document).ready(function() {
        $('.update_button').on('click', function() {
            $('#updateModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
            return $(this).text();
            }).get();

            console.log(data);

            $('#editProduct').val(data[1]);
            $('#editCustomer').val(data[2]);
            $('#editUser').val(data[3]);
            $('#editDate').val(data[4]);
            $('#editQuantity').val(data[5]);
            

            // confirm update button
            $('#update_data_btn').off().on('click', function(e) {
            e.preventDefault();

            var id = data[0]; // Get the sales ID from the data array

            $.ajax({
                method: "POST",
                url: "update_sales.php",
                data: {
                'update_data_btn': true,
                'sales_id': id,
                'editProduct': $('#editProduct').val(),
                'editCustomer': $('#editCustomer').val(),
                'editUser': $('#editUser').val(),
                'editDate': $('#editDate').val(),
                'editQuantity': $('#editQuantity').val(),
                },
                success: function(response) {
                console.log(response);
                // Perform any additional actions after successful update
                // Perform UI update after successful update
                if (response === 'successful') {
                    // Reload the page
                    location.reload();
                    }
                }
                });
            });
            });
        });
    </script>
</body>

</html>