   <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Stefan Stojcic 2016</p>
                </div>
            </div>
            <!-- /.row -->

        </footer>

    </div>
    <!-- /.container -->
 <script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  
        <script src="<?php echo base_url();?>js/ajax.js"></script>
     <script >  
     $(document).on('click','.brisanje', function(e){
                e.preventDefault();
                var id = $(this).data('idkorisnik'); // linku zadati atribut ->  data - 'idPost'
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url();?>administracija/brisanje/korisnici/'+id,
                    success: function(podaci)
                    {
                       document.getElementById("prikaz_ajax").innerHTML = podaci;
                    }
                });
                
            
                });</script>
     <script type="text/javascript">
(function() {

    var quotes = $(".quotes");
    var quoteIndex = -1;

    function showNextQuote() {
        ++quoteIndex;
        quotes.eq(quoteIndex % quotes.length)
            .fadeIn(2000)
            .delay(2000)
            .fadeOut(2000, showNextQuote);
    }

    showNextQuote();

})();
        
        </script>
</body>
</html>