<?php
    include( 'connections/db_connect.php' );//connect to the database
    require 'include/header.php';
    require 'utilities/Category.php';


    $INVOICES = "";
    if ( isset( $_POST[ 'view_invoice' ] ) ) {
        $range     = $_POST[ 'daterange' ];
        $date_from = explode( " - ", $range )[ 0 ];
        $date_to   = explode( " - ", $range )[ 1 ];
        //die($date_to);
    }

    if ( isset( $_SESSION[ 'retailer_user_id' ] ) ) {
        $retailer_id = $conn->real_escape_string( $_SESSION[ 'retailer_user_id' ] );
    } else {
        $retailer_id = - 1;
    }

    $retailer_invoice_sql    = 'SELECT `user_ip`, `item_clicked`, (select name from category where category.category_ID =retailer_invoice_trail.category limit 1)as `category_name`, ROUND(`amount`,2) as `amount`, `invoice_type`, `posted_timestamp` FROM `retailer_invoice_trail` where `retailer_id`=' . $retailer_id . ' and `posted_timestamp` BETWEEN "' . $date_from . '" AND "' . $date_to . '" UNION ALL SELECT "Total Budget Balance" AS`user_ip`, "" AS`item_clicked`, "" AS`category_name`, ROUND(SUM(`amount`),2) `amount`, "" AS`invoice_type`, "" AS`posted_timestamp` FROM `retailer_invoice_trail` where `retailer_id`=' . $retailer_id . ' and `posted_timestamp` BETWEEN "' . $date_from . '" AND "' . $date_to . '"';
    $retailer_invoice_result = $conn->query( $retailer_invoice_sql );

?>

<div class="container-fluid">
    <div class="row">
        <nav id="mob-menu-wrapper" class="hidden-xs">
            <?php include 'include/dashboard_navigation.php'; ?>
        </nav> <!-- end navigation -->

        <div class="col-md-11 col-lg-11 col-sm-11 col-xs-12 col-md-offset-2 col-lg-offset-2 col-sm-offset-3">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-9">
                    <div class="box box-wrapper cf">
                        <div class="box-header">
                            <h4>Refine your search</h4>
                        </div>
                        <div class="box-body">
                            <h4 class="sub-title">Filter by date:</h4>
                            <span id="error"></span>
                            <div class="fl-form-wrapper">
                                <form method="POST" id="view_invoice_form"
                                      action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>">
                                    <div class="input-group">
                                        <input type="text" data-date-format="yyyy-mm-dd"
                                               data-date-viewmode="years" id="daterange" name="daterange"
                                               class="date-time-range">
                                        <span class="input-group-addon"> <i
                                                    class="fa fa-calendar"></i> </span>
                                    </div>
                                    <div style="margin: 15px 0;" class="input-group">
                                        <input type="submit"
                                               name="view_invoice"
                                               class="form-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8 col-lg-8 col-sm-9">
                    <div class="box box-wrapper">
                        <div class="box-header">
                            <h4>Invoices</h4>
                        </div>
                        <div class="box-body">
                            <table id="invoice_list">
                                <thead>
                                <tr>
                                    <th>IP Address</th>
                                    <th>Item Clicked</th>
                                    <th>Timestamp</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Cost(GH&cent;)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ( $retailer_invoice_result->num_rows > 0 ) {
                                        while ( $row = $retailer_invoice_result->fetch_assoc() ) {
                                            ?>
                                            <tr <?php if ( isset( $row[ 'invoice_type' ] ) && trim( $row[ 'invoice_type' ] ) === "BUDGET_SET" ) {
                                                echo "style='color: green;'";
                                            } else if ( isset( $row[ 'invoice_type' ] ) && trim( $row[ 'invoice_type' ] ) === "ITEM_CLICKED" ) {
                                                echo "style='color: #f03224;'";
                                            } else {
                                                echo "";
                                            } ?> >
                                                <td><?php if ( isset( $row[ 'user_ip' ] ) && trim( $row[ 'user_ip' ] ) === "Total Budget Balance" ) {
                                                        echo "<strong>" . $row[ 'user_ip' ] . "</strong>";
                                                    } else {
                                                        echo $row[ 'user_ip' ];
                                                    } ?></td>
                                                <td><?php if ( isset( $row[ 'item_clicked' ] ) && trim( $row[ 'item_clicked' ] ) != "" ) {
                                                        echo "<a href='" . $row[ 'item_clicked' ] . "' target='new'>View Product</a>";
                                                    } else {
                                                        echo "";
                                                    } ?>

                                                </td>
                                                <td><?php echo $row[ 'posted_timestamp' ]; ?></td>
                                                <td><?php echo $row[ 'category_name' ]; ?></td>
                                                <td><?php echo str_replace( "_", " ", $row[ 'invoice_type' ] ); ?></td>
                                                <td style="text-align: left;"><?php if ( isset( $row[ 'user_ip' ] ) && trim( $row[ 'user_ip' ] ) === "Total Budget Balance" ) {
                                                        echo "<strong>" . $row[ 'amount' ] . "</strong>";
                                                    } else {
                                                        echo $row[ 'amount' ];
                                                    } ?> </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'include/scripts.php'; ?>

<script type="text/javascript">
    $(function () {
        $(document).ready(function () {
            $('#invoice_list').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            });
        });

        $('.date-time-range').daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            format: 'YYYY-MM-DD h:mm'
        });

        var form_input = $('#daterange'),
            error_msg = $('span#error');


        $('#view_invoice_form').submit(function () {
            if (form_input.val() === '' || form_input.val() == undefined || isEmpty(form_input.val())) {
                error_msg.text("Please select a date range");
                return false;
            } else {
                return true;
            }
        });

    });
</script>
<?php require 'include/footer.php'; ?>
