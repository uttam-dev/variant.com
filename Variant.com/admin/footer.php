    <style>
        footer{
    background: var(--bg-color);
    color: var(--text-color);
    display: flex;
    justify-content:center;
    padding: 1.5rem 10rem ;
}

footer .copyrights {
    display: flex;
    align-items: center;
    font-family: sans-serif;
    color: rgb(155, 155, 155);
    gap: 1rem;
    text-transform: capitalize;
    font-size: 1rem;
}
footer .copyrights .logo {
    width: 60px;
}

footer .logo img{
    width: 100%;
}
footer .copyrights .text{
    margin-top:1rem ;
}
    </style>
    
    <footer>
        <div class="copyrights">
            <div class="logo"><img src="../assets\img\web_img\variant_logo.png" alt=""></div>
            <div class="text">
                &copy; Variant.com
                <?php echo date("Y"); ?>
            </div>
        </div>
    </footer>
