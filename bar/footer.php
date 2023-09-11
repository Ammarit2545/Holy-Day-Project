<!-- Footer -->
<footer class="footer-container">

    <div class="container">
        <div class="row">

            <div class="col">
                &copy; Holy Day <?php if(isset($row_e['e_fname'])){

                ?><a href="#"><?= $row_e['e_fname'].' '.$row_e['e_lname'] ?></a>.<?php } ?>
            </div>

        </div>
    </div>

</footer>