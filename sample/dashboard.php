<?php
include 'header.php';
?>
    <div class="dashboard_center">
        <div class="row">
            <div class="col-md-1"></div>           
            
            <div class="col-md-10" >
                <span style="float:right;padding-top:10px">
                <button type="button" class="btn btn-dark" onclick="add_product();">Add Product</button>&nbsp;<span id="del_btn_holder" style="display:none;"><button type="button" class="btn btn-danger" onclick="delete_all_products();">Delete Product(s)</button></span>
                <div class="clear"><br></div>
                </span>
                <?php
                $sql = "SELECT <QUERY_FIELD> FROM products WHERE 1 ";
                                
                $totalSQL 	= str_replace('<QUERY_FIELD>', "COUNT(product_id) as RESULTS", $sql);
                $sql = str_replace('<QUERY_FIELD>', '*', $sql);

                $result=mysqli_query($con,$sql);
                                        
                ?>
                <table class="table table-striped table-bordered" > 
                    <tr>
                        <th>SNo</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Status</th>
                        <th>Product Image</th>
                        <th>Select All &nbsp;<input type="checkbox" id="selectall" /></th>
                        <th>Action</th>                
                    </tr>
                    <?php
                    $k = 0;                    
                    while($row = mysqli_fetch_array($result)) 
                    {
                        $k++;
                        $prod_image = '';
                    ?>
                    <tr>
                        <td><?=$k?></td>
                        <td><?php echo 'PROD'.str_pad($row['product_id'], 5, '0', STR_PAD_LEFT)?></td>
                        <td><?=$row['product_name']?></td>
                        <td><?='&pound;'.number_format($row['product_price'],2)?></td>
                        <td><?=$row['product_status']?></td>
                        <td>
                            <?php
                            if($row['product_image']!=''){
                                $prod_image = 'uploads/'.$row['product_image'];
                                echo '<img src="'.$prod_image.'" height="80" />';
                            }
                            ?>
                        </td>
                        <td style="text-align:center"><input type="checkbox" class="pid_cls" value="<?=$row['product_id']?>" /></td>
                        <td>
                            <a title="Edit" href="javascript:;" style="color:#000;" onclick="edit_product('<?=$row['product_id']?>');"><i class="fa fa-edit"></i></a>&nbsp;
                            <a title="Delete" style="color:#000;" href="javascript:;" onclick="delete_product('<?=$row['product_id']?>');"><i class="fa fa-trash"></i></a>
                        </td>                
                    </tr>
                    <?php 
                    }
                    if($k==0){
                    ?>
                    <tr>
                        <td colspan="8">No products found</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-md-1"></div>           
            
        </div>
    </div>
    <script>
    $(document).ready(function(){
        $("#selectall").click(function () {
            $('.pid_cls').prop('checked', this.checked);
            var selectall_count = $("#selectall:checked").length;
            var check_count =$(".pid_cls:checked").length;
            if(check_count>0){
                $('#del_btn_holder').show();
            }else{
                $('#del_btn_holder').hide();
            }
        });

        $(".pid_cls").click(function(){
            var check_count =$(".pid_cls:checked").length;
            if(check_count>0){
                var select_value = this.value;
                $('#del_btn_holder').show();
            }else{
                $('#del_btn_holder').hide();
            }
            if($(".pid_cls").length == $(".pid_cls:checked").length) {
                $("#selectall").prop("checked", "checked");
            } else {
                $("#selectall").removeAttr("checked");
            }
        });
    });

    function add_product() {
        var table = '<div id="content_holder"><span class="loading">Loading...<span></div>';
        div = bootbox.dialog({
            message: table,
            onOpen: function () {
                $.post('add_product.php', function (data, status) {
                    $("#content_holder").html(data);
                });
            }
        }).attr("id", "new_popup");
    }

    function edit_product(prod_id) {
        var table = '<div id="content_holder"><span class="loading">Loading...<span></div>';
        div = bootbox.dialog({
            message: table,
            onOpen: function () {
                $.post('edit_product.php',{prod_id:prod_id}, function (data, status) {
                    $("#content_holder").html(data);
                });
            }
        }).attr("id", "new_popup");
    }

    function delete_product(id){
        var conf = confirm('Are you sure?');
        if(conf==true){
            $.post('delete_product.php',{prod_id:id}, function (data) {
                if(data){
                    location.reload();
                }                
            });
        }
    }

    function delete_all_products(){
        var prodIds = '0';
    
        $(".pid_cls").each(function(){
            if(this.checked){
                prodIds+=','+$(this).val(); 
            }            
        });
        
        if(prodIds!='0'){
            var conf = confirm('Are you sure?');
            if(conf==true){
                var table = '<div id="content_holder"><span class="loading">Loading...<span></div>';
                div = bootbox.dialog({
                    message: table,
                    onOpen: function () {
                        $("#content_holder").html('<br><br><span style="padding:20px;color:#ff0000;">Please wait until process complete</span>');
                    }
                });
                $.post('delete_product.php',{prodIds:prodIds}, function (data) {
                    if(data){
                        location.reload();
                    }                
                });
            }
        }
    }
    </script>
<?php
include 'footer.php';
?>
        