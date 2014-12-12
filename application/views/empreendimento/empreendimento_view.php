<div class="col-md-10 posicao_conteiner" style="height: auto; background-repeat: no-repeat; ">
    <h3 style="text-align: left;  margin-top: 50px; margin-bottom: 20px;">Super Mercado do Zé</h3>
    <div class="row">

        <div class="col-md-4 margen_baixo">
            <div class="thumbnail imagen_lista">
                <img src="<?php echo base_url('imagens/imagen_teste.jpg') ?>">
                <div class="caption alinha_direita">

                    <p>
                        sdfasdf sdfsdfs sdfsadfsad asdfasdf asdfasdfasdf sdfasdf sdfsdfs sdfsadfsad asdfasdf asdfasdfasdf.
                        sdfasdf sdfsdfs sdfsadfsad asdfasdf asdfasdfasdf sdfasdf sdfsdfs sdfsadfsad asdfasdf asdfasdfasdf.
                        sdfasdf sdfsdfs sdfsadfsad asdfasdf asdfasdfasdf sdfasdf sdfsdfs sdfsadfsad asdfasdf asdfasdfasdf.
                        sdfasdf sdfsdfs sdfsadfsad asdfasdf asdfasdfasdf sdfasdf sdfsdfs sdfsadfsad asdfasdf asdfasdfasdf.

                    </p>
                    <div class="panel panel-default">
                        <div class="panel-heading">Contato(s)</div>
                        <div class="panel-body">
                            (38) 3234 - 0000 <a href="#">Contatos@yahoo.com.br</a>
                        </div>
                    </div>

                    <a href="#">Curtir <span class="badge">42</span></a> 
                    <a href="#">Compartilhar <span class="badge">42</span></a>

                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="thumbnail carrocel_empreendimento">
                <div class="slider">
                    <a class="arrow next"></a>
                    <a class="arrow prev"></a>
                    <ul>
                        <li class="active">
                            <img src="http://gurushots.com/uploads/f5e48ab33da68a375fb54785724fe939/3_fc57f55cea96654059b761080c2a5ff8.jpg"/>
                            <div class="content">
                                <h1>photo by </h1>
                                <div class="by">
                                    <span>Georgi Karastoyanov</span>
                                    <a href="http://gurushots.com" target="blank">GuruShots.com</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img data-src="http://gurushots.com/uploads/a91c155c523d0ae8b0492a5bff93e9aa/3_33a40264ce7459b576cbdc20492d7ddd.jpg"/>
                            <div class="content">
                                <h1>photo by </h1>
                                <div class="by">
                                    <span>Marek Saj</span>
                                    <a href="http://gurushots.com" target="blank">GuruShots.com</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img data-src="http://gurushots.com/uploads/084d009da314b5dda674a9e535089cb0/3_8bea9c037cc7783955626482c3f83633.jpg"/>
                            <div class="content">
                                <h1>photo by </h1>
                                <div class="by">
                                    <span>Deb Adkins</span>
                                    <a href="http://gurushots.com" target="blank">GuruShots.com</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img data-src="http://gurushots.com/uploads/f97cb5366ec9b793f0f746319cd35b17/3_4e980ef7c1509590e0379bf82120acda.jpg"/>
                            <div class="content">
                                <h1>photo by </h1>
                                <div class="by">
                                    <span>Serdar Selhep</span>
                                    <a href="http://gurushots.com" target="blank">GuruShots.com</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img data-src="http://gurushots.com/uploads/280fbdfd35283ef52c9620253556b83b/3_dee6cf4bcb8643081881d150352dd5fe.jpg"/>
                            <div class="content">
                                <h1>photo by </h1>
                                <div class="by">
                                    <span>Simon Beevers</span>
                                    <a href="http://gurushots.com" target="blank">GuruShots.com</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img data-src="http://gurushots.com/uploads/46e1f4293309e64eaea73046b6361b93/3_15bcc32e71971675d327a12508a5b903.jpg"/>
                            <div class="content">
                                <h1>012345678901234567890123456789012345678901234567890123456789</h1>
                                <div class="by">
                                    <span>Shahar Ratzenberg</span>
                                    <a href="http://gurushots.com" target="blank">GuruShots.com</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- SCRIPTS -->
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                <script src="<?php echo base_url('js/jquery.touch.js') ?>"></script>
                <script src="<?php echo base_url('js/saSlider.js') ?>"></script>
                <script>
                    // init slider plugin
                    var slider = $('.slider'),
                            saSlider = slider.saSlider().data('_saSlider');

                    // lazy load all photos that should be lazy loaded..
                    slider.find('img[data-src]').each(function () {
                        this.src = this.getAttribute('data-src');
                    });

                    $('#changeMode').on('click', changeMode);

                    var mode;

                    function changeMode() {
                        $('.slider').toggleClass('mode2');
                        setTimeout(function () {
                            saSlider.indicators.mark.apply(saSlider).checkOrientation.apply(saSlider);
                        }, 1000);
                    }
                </script>



            </div>
        </div>




    </div>
</div>

</div>

