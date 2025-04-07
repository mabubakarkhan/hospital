
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>User Profile</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript://"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Patients</li>
                    <li class="breadcrumb-item active">Patient Profile</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="user-profile">
              <div class="row">
                <!-- user profile header start-->
                <div class="col-sm-12">
                  <div class="card profile-header"><img class="img-fluid bg-img-cover" src="../assets/images/user-profile/bg-profile.jpg" alt="">
                    <div class="profile-img-wrrap"><img class="img-fluid bg-img-cover" src="../assets/images/user-profile/bg-profile.jpg" alt=""></div>
                    <div class="userpro-box">
                      <div class="img-wrraper">                              
                        <div class="avatar"><img class="img-fluid" alt="" src="<?=IMG.'user/'.$patient['gender']?>"></div>
                        <?php if ($permissions == 'all' || in_array('patient_edit', $permissions)): ?>
                            <a class="icon-wrapper editPatientBtn" href="javascript://" data-id="<?=$patient['patient_id']?>" data-fname="<?=$patient['fname']?>" data-lname="<?=$patient['lname']?>" data-mobile="<?=$patient['mobile']?>" data-address="<?=$patient['address']?>" data-id-card="<?=$patient['id_card']?>" data-gender="<?=$patient['gender']?>" data-age="<?=$patient['age']?>"><i class="icofont icofont-pencil-alt-5"></i></a>
                        <?php endif ?>
                      </div>
                      <div class="user-designation">
                        
                        <div class="title"><a target="_blank" href="#"> 
                          <h4><?=$patient['fname'].' '.$patient['lname']?></h4>
                          <h6 class="f-w-500"><?=$patient['mobile']?></h6></a>
                        </div>
                        
                        <div class="follow">
                          <ul class="follow-list">
                            <li>
                              <div class="follow-num counter"><?=$patient['gender']?></div><span>Gender</span>
                            </li>
                            <li>
                              <div class="follow-num counter"><?=$patient['age']?></div><span>Age</span>
                            </li>
                            <li>
                              <div class="follow-num counter"><?=$patient['patient_id']?></div><span>ID</span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- user profile header end-->
                <div class="col-xl-3 col-lg-4 col-md-5 xl-35 box-col-40">
                  <div class="default-according style-1 job-accordion">
                    <div class="row">
                      
                      <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="p-0">
                              <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon8" aria-expanded="true" aria-controls="collapseicon8">History</button>
                            </h5>
                          </div>
                          <div class="collapse show" id="collapseicon8" aria-labelledby="collapseicon8" data-parent="#accordion">
                            <div class="card-body social-list filter-cards-view">
                              <?php foreach ($history as $key => $historyQ): ?>
                                <?php if ($historyQ['type'] == 'emergency'): ?>
                                  <?php $historyDetailRedirectUrl = BASEURL.'prescription/new/true/?id='.$historyQ['id']; ?>
                                <?php else: ?>
                                  <?php $historyDetailRedirectUrl = BASEURL.'prescription/new/?id='.$historyQ['id']; ?>
                                <?php endif ?>
                                <div class="d-flex">
                                  <a href="<?=$historyDetailRedirectUrl?>" target="_blank"><div class="flex-grow-1"><span class="d-block"><?=date('d F, Y',strtotime($historyQ['at']))?></span><a href="javascript:void(0)"><?=$historyQ['type']?></a></div></a>
                                </div>
                              <?php endforeach ?>

                            </div><!-- /card-body -->
                          </div>
                        </div>
                      </div><!-- /12 -->
                      <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="p-0">
                              <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon11" aria-expanded="true" aria-controls="collapseicon11">Followings</button>
                            </h5>
                          </div>
                          <div class="collapse show" id="collapseicon11" aria-labelledby="collapseicon11" data-parent="#accordion">
                            <div class="card-body social-list filter-cards-view">
                              <div class="d-flex"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../assets/images/user/3.png">
                                <div class="flex-grow-1"><span class="d-block">Sarah Loren</span><a href="javascript:void(0)">Add Friend</a></div>
                              </div>
                              <div class="d-flex"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../assets/images/user/2.png">
                                <div class="flex-grow-1"><span class="d-block">Bucky Barnes</span><a href="javascript:void(0)">Add Friend</a></div>
                              </div>
                              <div class="d-flex"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../assets/images/user/10.jpg">
                                <div class="flex-grow-1"><span class="d-block">Comeren Diaz</span><a href="javascript:void(0)">Add Friend</a></div>
                              </div>
                              <div class="d-flex"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../assets/images/user/3.jpg">
                                <div class="flex-grow-1"><span class="d-block">Jason Borne</span><a href="javascript:void(0)">Add Friend</a></div>
                              </div>
                              <div class="d-flex"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../assets/images/user/11.png">
                                <div class="flex-grow-1"><span class="d-block">Andew Jon</span><a href="javascript:void(0)">Add Friend</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- /12 -->
                      <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="p-0">
                              <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon4" aria-expanded="true" aria-controls="collapseicon4">Latest Photos</button>
                            </h5>
                          </div>
                          <div class="collapse show" id="collapseicon4" data-parent="#accordion" aria-labelledby="collapseicon4">
                            <div class="card-body photos filter-cards-view">
                              <ul>
                                <li>
                                  <div class="latest-post"><img class="img-fluid" alt="" src="../assets/images/social-app/post-1.png"></div>
                                </li>
                                <li>
                                  <div class="latest-post"><img class="img-fluid" alt="" src="../assets/images/social-app/post-2.png"></div>
                                </li>
                                <li>
                                  <div class="latest-post"><img class="img-fluid" alt="" src="../assets/images/social-app/post-3.png"></div>
                                </li>
                                <li>
                                  <div class="latest-post"><img class="img-fluid" alt="" src="../assets/images/social-app/post-4.png"></div>
                                </li>
                                <li>
                                  <div class="latest-post"><img class="img-fluid" alt="" src="../assets/images/social-app/post-5.png"></div>
                                </li>
                                <li>
                                  <div class="latest-post"><img class="img-fluid" alt="" src="../assets/images/social-app/post-6.png"></div>
                                </li>
                                <li>
                                  <div class="latest-post"><img class="img-fluid" alt="" src="../assets/images/social-app/post-7.png"></div>
                                </li>
                                <li>
                                  <div class="latest-post"><img class="img-fluid" alt="" src="../assets/images/social-app/post-8.png"></div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div><!-- /12 -->
                      <div class="col-sm-12">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="p-0">
                              <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon13" aria-expanded="true" aria-controls="collapseicon13">Friends</button>
                            </h5>
                          </div>
                          <div class="collapse show" id="collapseicon13" data-parent="#accordion" aria-labelledby="collapseicon13">
                            <div class="card-body avatar-showcase filter-cards-view">
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/3.jpg" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/5.jpg" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/2.png" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/3.png" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/6.jpg" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/10.jpg" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/14.png" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/4.jpg" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/11.png" alt="#"></div>
                              <div class="d-inline-block friend-pic"><img class="img-50 rounded-circle" src="../assets/images/user/8.jpg" alt="#"></div>
                            </div>
                          </div>
                        </div>
                      </div><!-- /12 -->

                    </div>
                  </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7 xl-65 box-col-60">
                  <div class="row">
                    <!-- profile post start-->
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="profile-post">
                          <div class="post-header">
                            <div class="d-flex"><img class="img-thumbnail rounded-circle me-3" src="../assets/images/user/7.jpg" alt="Generic placeholder image">
                              <div class="flex-grow-1 align-self-center"><a href="social-app.html">
                                  <h5 class="user-name">Emay Walter</h5></a>
                                <h6 class="f-w-500">22 Hours ago</h6>
                              </div>
                            </div>
                            <div class="post-setting"><i class="fa fa-ellipsis-h"></i></div>
                          </div>
                          <div class="post-body">
                            <div class="img-container">
                              <div class="my-gallery" itemscope="">
                                <figure itemprop="associatedMedia" itemscope=""><a href="../assets/images/user-profile/post1.jpg" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid" src="../assets/images/user-profile/post1.jpg" itemprop="thumbnail" alt="gallery"></a>
                                  <figcaption itemprop="caption description">Image caption  1</figcaption>
                                </figure>
                              </div>
                            </div>
                            <div class="post-react">
                              <ul>
                                <li><img class="rounded-circle" src="../assets/images/user/3.jpg" alt=""></li>
                                <li><img class="rounded-circle" src="../assets/images/user/5.jpg" alt=""></li>
                                <li><img class="rounded-circle" src="../assets/images/user/1.jpg" alt=""></li>
                              </ul>
                              <h6 class="f-w-500">+5 people react this post</h6>
                            </div>
                            <p>Dressing is a way of life. My customers are successful working women. I want people to be afraid of the women I dress. Age is something only in your head or a stereotype. Age means nothing when you are passionate about something. There has to be a balance between your mental satisfaction and the financial needs of your company.</p>
                            <ul class="post-comment">
                              <li>
                                <label><a href="#"><i data-feather="heart"></i>&nbsp;&nbsp;Like<span class="counter">50</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i data-feather="message-square"></i>&nbsp;&nbsp;Comment<span class="counter">70</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i data-feather="share"></i>&nbsp;&nbsp;share<span class="counter">20</span></a></label>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- profile post end-->
                    <!-- profile post start-->
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="profile-post">
                          <div class="post-header">
                            <div class="d-flex"><img class="img-thumbnail rounded-circle me-3" src="../assets/images/user/7.jpg" alt="Generic placeholder image">
                              <div class="flex-grow-1 align-self-center"><a href="social-app.html">
                                  <h5 class="user-name">Emay Walter</h5></a>
                                <h6 class="f-w-500">5 Hours ago</h6>
                              </div>
                            </div>
                            <div class="post-setting"><i class="fa fa-ellipsis-h"></i></div>
                          </div>
                          <div class="post-body">
                            <div class="img-container">
                              <div class="row mt-4 pictures my-gallery" itemscope="">
                                <figure class="col-sm-6" itemprop="associatedMedia" itemscope=""><a href="../assets/images/user-profile/post2.jpg" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid" src="../assets/images/user-profile/post2.jpg" itemprop="thumbnail" alt="gallery"></a>
                                  <figcaption itemprop="caption description">Image caption  1</figcaption>
                                </figure>
                                <figure class="col-sm-6" itemprop="associatedMedia" itemscope=""><a href="../assets/images/user-profile/post3.jpg" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid" src="../assets/images/user-profile/post3.jpg" itemprop="thumbnail" alt="gallery"></a>
                                  <figcaption itemprop="caption description">Image caption  2</figcaption>
                                </figure>
                              </div>
                            </div>
                            <div class="post-react">
                              <ul>
                                <li><img class="rounded-circle" src="../assets/images/user/3.jpg" alt=""></li>
                                <li><img class="rounded-circle" src="../assets/images/user/5.jpg" alt=""></li>
                                <li><img class="rounded-circle" src="../assets/images/user/1.jpg" alt=""></li>
                              </ul>
                              <h6 class="f-w-500">+25 people react this post</h6>
                            </div>
                            <p>Success isn't about the end result, it's about what you learn along the way. Confidence. If you have it, you can make anything look good. Grunge is a hippied romantic version of punk. I'm an accomplice to helping women get what they want. Clothes can transform your mood and confidence. I think it's an old fashioned notion that fashion needs to be exclusive to be fashionable.</p>
                            <ul class="post-comment">
                              <li>
                                <label><a href="#"><i data-feather="heart"></i>&nbsp;&nbsp;Like<span class="counter">20</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i data-feather="message-square"></i>&nbsp;&nbsp;Comment<span class="counter">85</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i data-feather="share"></i>&nbsp;&nbsp;share<span class="counter">30</span></a></label>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- profile post end   -->
                    <!-- profile post start-->
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="profile-post">
                          <div class="post-header">
                            <div class="d-flex"><img class="img-thumbnail rounded-circle me-3" src="../assets/images/user/7.jpg" alt="Generic placeholder image">
                              <div class="flex-grow-1 align-self-center"><a href="social-app.html">
                                  <h5 class="user-name">Emay Walter</h5></a>
                                <h6>2 Hours ago</h6>
                              </div>
                            </div>
                            <div class="post-setting"><i class="fa fa-ellipsis-h"></i></div>
                          </div>
                          <div class="post-body">
                            <div class="img-container">
                              <div class="my-gallery" itemscope="">
                                <figure itemprop="associatedMedia" itemscope=""><a href="../assets/images/user-profile/post4.jpg" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid" src="../assets/images/user-profile/post4.jpg" itemprop="thumbnail" alt="gallery"></a>
                                  <figcaption itemprop="caption description">Image caption  1</figcaption>
                                </figure>
                              </div>
                            </div>
                            <div class="post-react">
                              <ul>
                                <li><img class="rounded-circle" src="../assets/images/user/3.jpg" alt=""></li>
                                <li><img class="rounded-circle" src="../assets/images/user/5.jpg" alt=""></li>
                                <li><img class="rounded-circle" src="../assets/images/user/1.jpg" alt=""></li>
                              </ul>
                              <h6 class="f-w-500">+20 people react this post</h6>
                            </div>
                            <p>Comfort is very important to me. I think people live better in big houses and in big clothes. Design and style should work toward making you look good and feel good without a lot of effort so you can get on with the things that matter. My shows are about the complete woman who swallows it all. Its a question of survival. Those fashion designers are just crazy; but arent we all? You can only go forward by making mistakes.</p>
                            <ul class="post-comment">
                              <li>
                                <label><a href="#"><i data-feather="heart"></i>&nbsp;&nbsp;Like<span class="counter">40</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i data-feather="message-square"></i>&nbsp;&nbsp;Comment<span class="counter">30</span></a></label>
                              </li>
                              <li>
                                <label><a href="#"><i data-feather="share"></i>&nbsp;&nbsp;share<span class="counter">18</span></a></label>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- profile post end                           -->
                  </div>
                </div>
                <!-- user profile fifth-style end-->
                <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="pswp__bg"></div>
                  <div class="pswp__scroll-wrap">
                    <div class="pswp__container">
                      <div class="pswp__item"></div>
                      <div class="pswp__item"></div>
                      <div class="pswp__item"></div>
                    </div>
                    <div class="pswp__ui pswp__ui--hidden">
                      <div class="pswp__top-bar">
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                          <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                              <div class="pswp__preloader__donut"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                      </div>
                      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                      <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->