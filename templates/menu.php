<style>
  .site-menubar-unfold .site-menu-category {
    padding: 0 24px;
    margin-top: 20px;
    font-size: 15px;
    line-height: 38px;
    color: #76838f;
    text-transform: uppercase;
    -webkit-transition: all .25s, font .1s .15s, color .1s .15s;
    -o-transition: all .25s, font .1s .15s, color .1s .15s;
    transition: all .25s, font .1s .15s, color .1s .15s;
  }
</style>
<div class="site-menubar site-menubar-dark">
  <div class="site-menubar-header">
    <div class="cover overlay">
      <img class="cover-image" src="<?= base_url() ?>assets/default/examples/images/dashboard-header.jpg" alt="...">
      <div class="overlay-panel vertical-align overlay-background">
        <div class="vertical-align-middle">
          <a class="avatar avatar-lg" href="javascript:void(0)">
            <img src="<?= base_url() ?>assets/global/portraits/1.jpg" alt="">
          </a>
          <div class="site-menubar-info">
            <h5 class="site-menubar-user"><?= $this->session->userdata('nama') ?></h5>
            <p class="site-menubar-email"><?= $this->session->userdata('email') ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu" data-plugin="menu">
          <li class="site-menu-category" style="padding: 0 15px; margin-top: 20px; font-size: 15px; line-height: 38px;">ORDER PSB, PDA, & ADDON</li>
          <li class="site-menu-item">
            <a class="animsition-link" href="<?= site_url('welcome') ?>">
              <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
              <span class="site-menu-title">Dashboard PSB</span>
            </a>
          </li>

          <?php if (menuDashboardTeknisi($this->session->userdata('level'))) { ?>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?= site_url('welcome/teknisi') ?>">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard Teknisi</span>
              </a>
            </li>
          <?php } ?>

          <?php if (menuProduktifitasPsb($this->session->userdata('level'))) { ?>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?= site_url('welcome/produktifitas') ?>">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Produktifitas PSB</span>
              </a>
            </li>
          <?php } ?>

          <?php if (menuMonitoringBA($this->session->userdata('level'))) { ?>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?= site_url('welcome/monitoring_amunisi/psb') ?>">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Monitoring BA</span>
              </a>
            </li>
          <?php } ?>

          <?php if (menuProgressProvi($this->session->userdata('level'))) { ?>
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Progress Provi</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('welcome/provisioning'); ?>">
                    <span class="site-menu-title">PSB</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('welcome/pda'); ?>">
                    <span class="site-menu-title">PDA</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('welcome/addon'); ?>">
                    <span class="site-menu-title">ADD ON</span>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>

          <?php if (menuUpload($this->session->userdata('level'))) { ?>
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Upload</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('sales/upload/myi'); ?>">
                    <span class="site-menu-title">Upload MYI</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('sales/upload/dorong_ps'); ?>">
                    <span class="site-menu-title">Upload Dorong PS</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('sales/upload/reset_order'); ?>">
                    <span class="site-menu-title">Upload Reset Order</span>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>

          <?php if (menuRequestSc($this->session->userdata('level'))) { ?>
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Request SC</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">

                <?php if (subMenuInputSCPlasa($this->session->userdata('level'))) { ?>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="<?= site_url('sales/sc_input'); ?>">
                      <span class="site-menu-title">Input SC Plasa</span>
                    </a>
                  </li>
                <?php } ?>

                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('sales/dorong_myi'); ?>">
                    <span class="site-menu-title">Input SC MYI</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('sales/sc_update'); ?>">
                    <span class="site-menu-title">Update SC</span>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>

          <li class="site-menu-item has-sub">
            <a href="javascript:void(0)">
              <i class="site-menu-icon md-assignment-alert" aria-hidden="true"></i>
              <span class="site-menu-title">Kendala</span>
              <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
              <li class="site-menu-item">
                <a class="animsition-link" href="<?= site_url('sales/kendala'); ?>">
                  <span class="site-menu-title">All Kendala</span>
                </a>
              </li>
              <li class="site-menu-item">
                <a class="animsition-link" href="<?= site_url('sales/kendala/progress'); ?>">
                  <span class="site-menu-title">Progress Kendala</span>
                </a>
              </li>
            </ul>
          </li>

          <?php if (menuConstruction($this->session->userdata('level'))) { ?>
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon md-city-alt" aria-hidden="true"></i>
                <span class="site-menu-title">Construction</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('sales/construction'); ?>">
                    <span class="site-menu-title">SDI Design</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?= site_url('sales/project'); ?>">
                    <span class="site-menu-title">Project Construction</span>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>

          <?php if (menuUnscEngagement($this->session->userdata('level'))) { ?>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?= site_url('sales/unsc_engagement') ?>">
                <i class="site-menu-icon md-mood" aria-hidden="true"></i>
                <span class="site-menu-title">UNSC Engagement</span>
              </a>
            </li>
          <?php } ?>

          <li class="site-menu-item">
            <a class="animsition-link" href="<?= site_url('sales/track_order') ?>">
              <i class="site-menu-icon md-search-in-page" aria-hidden="true"></i>
              <span class="site-menu-title">Track Order</span>
            </a>
          </li>

          <?php if (menuReport($this->session->userdata('level'))) { ?>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?= site_url('sales/report') ?>">
                <i class="site-menu-icon md-case-download" aria-hidden="true"></i>
                <span class="site-menu-title">Report</span>
              </a>
            </li>
          <?php } ?>

          <?php if (menuMitra($this->session->userdata('level'))) { ?>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?= site_url('masters/mitra') ?>">
                <i class="site-menu-icon md-accounts" aria-hidden="true"></i>
                <span class="site-menu-title">Mitra</span>
              </a>
            </li>
          <?php } ?>

          <?php if (menuTeknisi($this->session->userdata('level'))) { ?>
            <li class="site-menu-item">
              <a class="animsition-link" href="<?= site_url('users/teknisi') ?>">
                <i class="site-menu-icon md-accounts" aria-hidden="true"></i>
                <span class="site-menu-title">Teknisi</span>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>