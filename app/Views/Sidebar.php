<aside class="sidebar navbar-default" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" readonly="true" class="form-control" placeholder="Quality Assurance">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-location-pin"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/"><i class="fa fa-user-circle"></i>  Profile</a>
                        </li>
                        <?php if(in_groups('supervisor')) :?>
                        <li>
                            <a href="/daftaruser"><i class="fa fa-user-circle"></i>  Kelola User</a>
                        </li>
                        <?php endif; ?>
                        <!-- //kalkual -->
                        <li>
                            <a href="#" class="menu-toggle"><i class="fa fa-folder fa-fw"></i> QA Kalkual<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="#" class="submenu-toggle fa fa-folder-open"> SO Barang <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level collapse">
                                        <?php if(in_groups(['supervisor', 'admin_kalkual',])) : ?>
                                        <li>
                                            <a href="/dashboardqakalkual" class="fa fa-tag"> Dashboard</a>
                                        </li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="/databarang" class="fa fa-tag"> Data Barang</a>
                                        </li>
                                        <?php if(in_groups(['supervisor', 'admin',])) : ?>
                                        <li>
                                            <a href="/laporanbarangmasuk" class="fa fa-tag"> Laporan Barang Masuk</a>
                                        </li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="/laporanbarangkeluar" class="fa fa-tag"> Laporan Barang Keluar</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- //admin QA                     -->
                        <li>
                            <a href="#" class="menu-toggle"><i class="fa fa-folder fa-fw"></i> Admin QA<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                               
                                <li>
                                    <a href="#" class="submenu-toggle fa fa-folder-open"> SO Alat Tulis QA <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level collapse">
                                        <?php if(in_groups(['supervisor', 'admin_qa'])) :?>
                                        <li>
                                            <a href="/dashboardadminqa" class="fa fa-tag"> Dashboard</a>
                                        </li>
                                         <?php endif; ?>
                                        <li>
                                            <a href="/databarangadminqa" class="fa fa-tag"> Data Barang</a>
                                        </li>
                                        <?php if(in_groups(['supervisor', 'admin_qa'])) :?>
                                        <li>
                                            <a href="/laporan_brg_masuk" class="fa fa-tag"> Laporan Barang Masuk</a>
                                        </li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="/laporan_brg_keluar" class="fa fa-tag"> Laporan Barang Keluar</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>
                       
                    </ul>
                </div>
</aside>
<!-- /.sidebar -->
            