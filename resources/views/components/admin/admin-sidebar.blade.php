  <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
          <div>
              <img src="{{ asset('admin/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
          </div>
          <div>
              <h4 class="logo-text">{{ Auth::user()->name }}</h4>
          </div>
          <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
          </div>
      </div>
      <!--navigation-->
      <ul class="metismenu" id="menu">
          <li>
              <a href="{{ route('admin.dashboard') }}" class="">
                  <div class="parent-icon"><i class='bx bx-home-circle'></i>
                  </div>
                  <div class="menu-title">Dashboard</div>
              </a>

          </li>
          <li>
              <a href="{{ route('admin.home_banner') }}" class="">
                  <div class="parent-icon"><i class='lni lni-adobe'></i>
                  </div>
                  <div class="menu-title">Home Banner</div>
              </a>

          </li>

          <li>
              <a href="javascript:;" class="has-arrow">
                  <div class="parent-icon"><i class='bx bx-cart'></i>
                  </div>
                  <div class="menu-title">eCommerce</div>
              </a>
              <ul>
                  <li> <a href="#"><i class="bx bx-right-arrow-alt"></i>Products</a>
                  </li>
                  <li> <a href="{{ route('admin.products.size.index') }}"><i class="bx bx-right-arrow-alt"></i>Size</a>
                  </li>
                  <li> <a href="{{ route('admin.manage.colors.index') }}"><i class="bx bx-right-arrow-alt"></i>Color</a>
                  </li>
                  <li>
                      <a href="javascript:;" class="has-arrow">
                          <div class="menu-title">Attributes</div>
                      </a>
                      <ul>
                          <li>
                              <a href="{{ route('admin.attribute.index') }}"><i
                                      class="bx bx-right-arrow-alt"></i>Attributes</a>
                          </li>
                          <li>
                              <a href="{{ route('admin.attribute_value.index') }}"><i
                                      class="bx bx-right-arrow-alt"></i>Attribute Values</a>
                          </li>
                      </ul>
                  </li>


              </ul>
          </li>



          {{-- <li class="menu-label">Pages</li> --}}

          {{-- <li>
              <a href="{{ route('admin.profile') }}">
                  <div class="parent-icon"><i class="bx bx-user-circle"></i>
                  </div>
                  <div class="menu-title">User Profile</div>
              </a>
          </li> --}}



          {{-- <li class="menu-label">Others</li>
          <li>
              <a class="has-arrow" href="javascript:;">
                  <div class="parent-icon"><i class="bx bx-menu"></i>
                  </div>
                  <div class="menu-title">Menu Levels</div>
              </a>
              <ul>
                  <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level One</a>
                      <ul>
                          <li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level
                                  Two</a>
                              <ul>
                                  <li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Three</a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </li>
              </ul>
          </li> --}}

      </ul>
      <!--end navigation-->
  </div>
