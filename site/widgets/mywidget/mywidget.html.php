<script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

<!--style start-->
<style>
    #rpotable_next, #rpotable_previous {
        font-size: 15px;
    }
    .container {
        padding: 5px
    }

    .sortable{
        position: relative;
        top: -1px;
    }

    .footer-left {
        width: 100%;
        display: inline-block;
    }

    .footer-right {
        width: 100%;
        display: inline-block;
        text-align: right;
    }

    .pointer {
        cursor: pointer;
    }

    button {
        margin-left: 15px;
        padding: 5px 10px 6px 10px;
    }

    table tr.sort:nth-child(even) {
        background: #f5f4f4;
    }

    table tr.sort:nth-child(odd) {
        background: #FFF;
    }

    .search-container {
        padding: 5px 0;
        border: 1px solid gray;
        margin-top: 7px;
        display: none;
    }

    .search-container input {
        margin: 5px 5px;
    }

    .extra-space {
        padding-top: 15px;
    }

    .extra-min-space {
        padding-top: 5px;
    }

    .search {
        padding-left: 10px;
    }

    .show-results {
        padding-right: 5px;
    }

    .prev,
    .next {
        font-size: 23px;
        font-weight: bolder;
    }

    .text-search-25 {
        width: 25%
    }

    .text-search-15 {
        width: 15%
    }

    .search-container {
        text-align: center;
    }

    .label-search {
        padding-left: 10px;
    }

    .hide {
        visibility: hidden;
    }

    .sort
    {
        visibility: visible;
    }


</style>
<!--style end-->

<table id="rpotable" width="100%">
    <thead>
        <th>Name</th>
        <th>Postcode</th>
        <th>Last Login</th>
        <th>Pet Total</th>
        <th>Course Total</th>
    </thead>
    <?php foreach($resultcourse as $item): ?>
        <?php $pets = db::table('pets')->where(array('user_id' => $item->id())); ?>
        <tr class="sort">
            <td style="text-align: left"><?php echo $item->firstname().' '.$item->lastname()?></td>
            <td><?php echo $item->postcode() ?></td>
            <td><?php echo $item->last_login() ?></td>
            <td style="text-align: center"><?php echo $pets->count() ?></td>
            <td style="text-align: center"><?php echo $item->course_count() ?></td>
        </tr>
    <?php endforeach ?>
</table>
<div class="footer-left extra-space" >
    <form action="../api/exportsql" style="display: inline-block">
        <button type="submit" class="export-button">Export as CSV</button>  
    </form>
    <form action="../api/exportcsv" style="display: inline-block">
        <button type="submit" class="export-button">Export as SQL</button>  
    </form>
</div>
<div class="container">
    <div class="footer-left extra-space">
        <div class="search-container">
            <input type="text" id="textFname" class="text-search-25">
            <input type="text" id="textPostcode" class="text-search-25">
            <input type="text" id="textCourse" class="text-search-15">
            <input type="text" id="textPet" class="text-search-15">
        </div>
    </div>

    <!-- SCRIPTS START (document.readyState === "complete") -->
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#rpotable').DataTable();
        });
    </script>

    
    <!--SCRIPTS END