<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/header.php' ?>  
    <div id="tooplate_main">
        <div class="content row">
            <div class="col-sm-9">
            <h2>Contact Us</h2>
            <div id="contact_form">
               <form method="post" name="contact" action="#">
                    
                    <label for="author">Name:</label> 
                    <input type="text" id="author" name="author" class="required input_field" />
                    <div class="cleaner h10"></div>
                    <label for="email">Email:</label> 
                    <input type="text" id="email" name="email" class="validate-email required input_field" />
                    <div class="cleaner h10"></div>
                    
                    <label for="phone">Phone:</label> 
                    <input type="text" name="phone" id="phone" class="input_field" />
                    <div class="cleaner h10"></div>
    
                    <label for="text">Message:</label> 
                    <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                    <div class="cleaner h10"></div>
                    
                    <input type="submit" class="submit_btn" name="submit" id="submit" value="Send" />
                    
                </form>
            </div>
            
            <div class="cleaner h40"></div>
            
            <div class="col one_third">
                <h5>Address One</h5>
                120-360 Duis lacinia dictum, <br />
                Vestibulum auctor, 10120<br />
                Nam rhoncus, diam a mollis tempor<br />
                Email: <a href="#">info@company.com</a></div>
            <div class="col one_third no_margin_right">
                <h5>Address Two</h5>
                240-480 Duis lacinia dictum, <br />
                Vestibulum auctor, 10240<br />
                Nam rhoncus, diam a mollis tempor<br />
                Email: <a href="#">contact@company.com</a>
            </div>
        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/right-bar.php' ?>       
        
       
        <div class="cleaner"></div>
    </div> <!-- END of tooplate_main -->   
    
</div> <!-- END of tooplate_wrapper -->

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/public/inc/footer.php' ?>