<html lang="en">
    <head>
    <meta charset="utf-8">
    <title>CS CASHIER</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="Metronic Shop UI description" name="description">
    <meta content="Metronic Shop UI keywords" name="keywords">
    <meta content="keenthemes" name="author">
    <meta property="og:site_name" content="-CUSTOMER VALUE-">
    <meta property="og:title" content="-CUSTOMER VALUE-">
    <meta property="og:description" content="-CUSTOMER VALUE-">
    <meta property="og:type" content="website">
    <meta property="og:image" content="-CUSTOMER VALUE-">
    <meta property="og:url" content="-CUSTOMER VALUE-">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo base_url();?>assets/admin.css" rel="stylesheet" type="text/css">       
    <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/global/css/components.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/frontend/layout/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/frontend/pages/css/portfolio.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/frontend/layout/css/style-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/frontend/layout/css/themes/red.css" rel="stylesheet" id="style-color">
    <link href="<?php echo base_url();?>assets/frontend/layout/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
    <link href="<?php echo base_url();?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet">
</head>
<body class="corporate">
        <div class="page-container">
            <div class="page-content" style="background: #ffffff;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="portlet light">
                                        <div class="portlet-body">
                                            <div class="row" style="text-align: center;">  
                                                <div class="col-xl-4 col-md-4 mb-30">  
                                                    <div class="single-cta" >  
                                                        <div class="cta-text">  
                                                            <h4><i class="fa fa-map-marker"></i> Find us </h4>  
                                                            <span>Upper Ground, North Wing, Island City Mall, Tagbilaran City, Bohol, Philippines 6300 <span>  
                                                        </div>  
                                                    </div>  
                                                </div>  
                                                <div class="col-xl-4 col-md-4 mb-30">  
                                                    <div class="single-cta">
                                                        <div class="cta-text">  
                                                            <h4><i class="fa fa-phone"></i> Call us </h4>  
                                                            <span> +1821 </span>  
                                                        </div>  
                                                    </div>  
                                                </div>  
                                                <div class="col-xl-4 col-md-4 mb-30">  
                                                    <div class="single-cta">   
                                                        <div class="cta-text">  
                                                            <h4><i class="fa fa-paper-plane"></i> Mail us </h4>  
                                                            <span>itsysdev@alturasbohol.com </span>  
                                                        </div>  
                                                    </div>  
                                                </div>  
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="meet_our_team" style="text-align: center;">
                                        <span style="--i:1">M</span>
                                        <span style="--i:2">E</span>
                                        <span style="--i:3">E</span>
                                        <span style="--i:4">T</span>
                                        <span style="--i:5"> </span>
                                        <span style="--i:6">O</span>
                                        <span style="--i:7">U</span>
                                        <span style="--i:8">R</span>
                                        <span style="--i:9"> </span>
                                        <span style="--i:10">T</span>
                                        <span style="--i:11">E</span>
                                        <span style="--i:12">A</span>
                                        <span style="--i:13">M</span>
                                    </div>
                                    <h4 style="margin-top: 40px; text-align: center; font-family: Georgia ;font-weight: bold; text-align: center">SUPERVISED BY:</h4>
                                    
                                    <!-- <div class="responsive-container-block container" style="margin-top: 60px;"> -->
                                        <div class="responsive-container-block" style="margin-top: 60px;">
                                            <?php if (isset($employees['43864-2013'])): ?>
                                            <div class="responsive-cell-block card-container">
                                                <div class="card">
                                                    <div class="team-image-wrapper">
                                                        <img class="team-member-image" src="http://<?php echo $employees['43864-2013']->photo ?>">
                                                    </div>
                                                    <p class="text-blk name">
                                                    <?php echo $employees['43864-2013']->name ?>
                                                    </p>
                                                    <p class="text-blk position">
                                                    <?php echo $employees['43864-2013']->position; ?>
                                                    </p>
                                                    <p class="text-blk feature-text">

                                                        <?php if($employees['43864-2013']->current_status != 'Active'){ ?>
                                                            <span class="label label-danger"> Inactive </span>
                                                        <?php }else{ ?>
                                                            <span class="label label-success"> <?php echo $employees['43864-2013']->current_status?> </span>
                                                        <?php } ?>

                                                    </p>
                                                    
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (isset($employees['21114-2013'])): ?>
                                            <div class="responsive-cell-block card-container">
                                                <div class="card">
                                                    <div class="team-image-wrapper">
                                                        <img class="team-member-image" src="http://<?php echo $employees['21114-2013']->photo ?>">
                                                    </div>
                                                    <p class="text-blk name">
                                                    <?php echo $employees['21114-2013']->name ?>
                                                    </p>
                                                    <p class="text-blk position">
                                                    <?php echo $employees['21114-2013']->position; ?>
                                                    </p>
                                                    <p class="text-blk feature-text">
                                                    <?php if($employees['21114-2013']->current_status != 'Active'){ ?>
                                                            <span class="label label-danger"> Inactive </span>
                                                        <?php }else{ ?>
                                                            <span class="label label-success"> <?php echo $employees['21114-2013']->current_status?> </span>
                                                        <?php } ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <h4 style=" margin-top: 40px; text-align: center; font-family: Georgia ;font-weight: bold">PROGRAMMERS | ANALYST:</h4>
                                    <div class="responsive-container-block container" style="margin-top: 40px;">
                                        <div class="responsive-container-block">
                                            <?php if (isset($employees['15797-2018'])): ?>
                                            <div class="responsive-cell-block card-container">
                                                <div class="card" style="height: 100%">
                                                    <div class="team-image-wrapper">
                                                        <img class="team-member-image" src="http://<?php echo $employees['15797-2018']->photo ?>">
                                                    </div>
                                                    <p class="text-blk name">
                                                    <?php echo $employees['15797-2018']->name ?>
                                                    </p>
                                                    <p class="text-blk position">
                                                    <?php echo $employees['15797-2018']->position; ?>
                                                    </p>
                                                    <p class="text-blk feature-text">
                                                    <?php if($employees['15797-2018']->current_status != 'Active'){ ?>
                                                            <span class="label label-danger"> Inactive </span>
                                                        <?php }else{ ?>
                                                            <span class="label label-success"> <?php echo $employees['15797-2018']->current_status?> </span>
                                                        <?php } ?>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <?php if (isset($employees['00902-2014'])): ?>
                                            <div class="responsive-cell-block card-container">
                                                <div class="card">
                                                    <div class="team-image-wrapper">
                                                        <img class="team-member-image" src="http://<?php echo $employees['00902-2014']->photo ?>">
                                                    </div>
                                                    <p class="text-blk name">
                                                    <?php echo $employees['00902-2014']->name ?>
                                                    </p>
                                                    <p class="text-blk position">
                                                    <?php echo $employees['00902-2014']->position; ?>
                                                    </p>
                                                    <p class="text-blk feature-text">
                                                    <?php if($employees['00902-2014']->current_status != 'Active'){ ?>
                                                            <span class="label label-danger"> Inactive </span>
                                                        <?php }else{ ?>
                                                            <span class="label label-success"> <?php echo $employees['00902-2014']->current_status?> </span>
                                                        <?php } ?>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                            <?php endif; ?>


                                            <!-- <?php if (isset($employees['02483-2023'])): ?> -->
                                            <div class="responsive-cell-block card-container">
                                                <div class="card">
                                                    <div class="team-image-wrapper">
                                                        <!-- <img class="team-member-image" src="<?php echo base_url('assets/assets/img/IMG.jpg') ?>"> -->
                                                        <img class="team-member-image" src="http://<?php echo $employees['02483-2023']->photo ?>">
                                                    </div>
                                                    <p class="text-blk name">
                                                    <?php echo $employees['02483-2023']->name; ?>
                                                    </p>
                                                    <p class="text-blk position">
                                                    <?php echo $employees['02483-2023']->position; ?>
                                                    </p>
                                                    <p class="text-blk feature-text">
                                                    <?php if($employees['02483-2023']->current_status != 'Active'){ ?>
                                                            <span class="label label-danger"> Inactive </span>
                                                        <?php }else{ ?>
                                                            <span class="label label-success"> <?php echo $employees['02483-2023']->current_status?> </span>
                                                        <?php } ?>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <h4 style=" margin-top: 40px; text-align: center; font-family: Georgia ;font-weight: bold">CREDITS: </h4>
                                    <div class="responsive-container-block container" style="margin-top: 40px;">
                                        <div class="responsive-container-block">
                                            <?php if (isset($employees['20528-2013'])): ?>
                                            <div class="responsive-cell-block card-container">
                                                <div class="card">
                                                    <div class="team-image-wrapper">
                                                        <img class="team-member-image" src="http://<?php echo $employees['20528-2013']->photo ?>">
                                                    </div>
                                                    <p class="text-blk name">
                                                    <?php echo $employees['20528-2013']->name ?>
                                                    </p>
                                                    <p class="text-blk position">
                                                    <?php echo $employees['20528-2013']->position; ?>
                                                    </p>
                                                    <p class="text-blk feature-text">
                                                    <?php if($employees['20528-2013']->current_status != 'Active'){ ?>
                                                            <span class="label label-danger"> Inactive </span>
                                                        <?php }else{ ?>
                                                            <span class="label label-success"> <?php echo $employees['20528-2013']->current_status?> </span>
                                                        <?php } ?>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <?php if (isset($employees['01779-2016'])): ?>
                                            <div class="responsive-cell-block card-container">
                                                <div class="card">
                                                    <div class="team-image-wrapper">
                                                        <img class="team-member-image" src="http://<?php echo $employees['01779-2016']->photo ?>">
                                                    </div>
                                                    <p class="text-blk name">
                                                    <?php echo $employees['01779-2016']->name ?>
                                                    </p>
                                                    <p class="text-blk position">
                                                    <?php echo $employees['01779-2016']->position; ?>
                                                    </p>
                                                    <p class="text-blk feature-text">
                                                    <?php if($employees['01779-2016']->current_status != 'Active'){ ?>
                                                            <span class="label label-danger"> Inactive </span>
                                                        <?php }else{ ?>
                                                            <span class="label label-success"> <?php echo $employees['01779-2016']->current_status?> </span>
                                                        <?php } ?>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <h4 style=" margin-top: 40px; text-align: center; font-family: Georgia ;font-weight: bold">FORMER MEMBER: </h4>
                                    <div class="responsive-container-block container" style="margin-top: 40px;">
                                        <div class="responsive-container-block">
                                            <?php if (isset($employees['05157-2015'])): ?>
                                            <div class="responsive-cell-block card-container">
                                                <div class="card">
                                                    <div class="team-image-wrapper">
                                                        <img class="team-member-image" src="http://<?php echo $employees['05157-2015']->photo ?>">
                                                    </div>
                                                    <p class="text-blk name">
                                                    <?php echo $employees['05157-2015']->name ?>
                                                    </p>
                                                    <p class="text-blk position">
                                                    <?php echo $employees['05157-2015']->position; ?>
                                                    </p>
                                                    <p class="text-blk feature-text">
                                                    <?php if($employees['05157-2015']->current_status != 'Active'){ ?>
                                                            <span class="label label-danger"> Inactive </span>
                                                        <?php }else{ ?>
                                                            <span class="label label-success"> <?php echo $employees['05157-2015']->current_status?> </span>
                                                        <?php } ?>
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        <!-- </div>   -->
                    </div>    
                </div>
            </div>
        </div>
        
    <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="<?php echo base_url();?>assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src="<?php echo base_url();?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script> 
    <script src="<?php echo base_url();?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script> 
    <script src="<?php echo base_url();?>assets/frontend/pages/scripts/revo-slider-init.js" type="text/javascript"></script>
</body>

<style>

        .single-cta i {  
            color: #ff5e14;  
            font-size: 20px;  
            margin-top: 8px;  
            
        }  
        .label-success {
            display: inline-block;
            padding: 5px 10px;
            color: #fff;
            animation: glow 1.5s infinite alternate;
        }

        @keyframes glow {
            from {
                background-color: #5cb85c;
            }
            to {
                background-color: #0077ff;
            }
        }

        .meet_our_team {
            position: relative;
            -webkit-box-reflect: below -20px linear-gradient(transparent, rgba(0, 0, 0, 0.2));
            font-size: 30px;
        }

        .meet_our_team span {
            font-family: 'Alfa Slab One', cursive;
            position: relative;
            display: inline-block;
            color: #000000;
            text-transform: uppercase;
            animation: meet_our_team 1s infinite;
            animation-delay: calc(.05s * var(--i));

        }

        @keyframes meet_our_team {

            0%,
            40%,
            100% {
                transform: translateY(0)
            }

            20% {
                transform: translateY(-6px)
            }
        }

        .responsive-cell-block {
            min-height: 75px;
        }

        .text-blk {
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
            margin-left: 0px;
            line-height: 20px;

           
        }

        .responsive-container-block {
            min-height: 75px;
            height: fit-content;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            margin-top: 0px;
            margin-right: auto;
            margin-bottom: 0px;
            margin-left: auto;
            justify-content: space-evenly;
        }

        .team-head-text {
            font-size: 48px;
            font-weight: 900;
            text-align: center;
        }

        .team-head-text {
            line-height: 50px;
            width: 100%;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 50px;
            margin-left: 0px;
        }

        .card {
            text-align: center;
            box-shadow: rgba(0, 0, 0, 0.32) 0px 4px 20px 7px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 30px;
            padding-right: 25px;
            padding-bottom: 30px;
            padding-left: 25px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .card-container {
            width: 280px;
            margin-top: 0px;
            margin-right: 10px;
            margin-bottom: 25px;
            margin-left: 10px;

        }

        .name {
            margin-top: 20px;
            margin-right: 0px;
            margin-bottom: 5px;
            margin-left: 0px;
            font-size: 18px;
            font-weight: 800;
            color: rgb(0, 162, 255);
            text-transform: uppercase;
        }

        .position {
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 10px;
            margin-left: 0px;
        }

        .feature-text {
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 20px;
            margin-left: 0px;
            color: rgb(122, 122, 122);
            line-height: 30px;
        }

        .social-icons {
            width: 70px;
            display: flex;
            justify-content: space-between;
        }

        .team-image-wrapper {
            clip-path: circle(50% at 50% 50%);
            width: 130px;
            height: 130px;
        }

        .team-member-image {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 500px) {
            .card-container {
                width: 100%;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 25px;
                margin-left: 0px;
            }
        }
    </style>
</html>