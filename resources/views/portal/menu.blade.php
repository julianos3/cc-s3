@if(!isset($config['menu']))
<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="{{ route('portal.home.index') }}">
                            <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon icon wb-grid-9" aria-hidden="true"></i>
                            <span class="site-menu-title">Condomínio</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">Meu Condomínio</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('portal.condominium.block.index') }}">
                                            <span class="site-menu-title">Blocos</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('portal.condominium.unit.index') }}">
                                            <span class="site-menu-title">Unidades</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('portal.condominium.unit.garage.index') }}">
                                            <span class="site-menu-title">Garagens</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item none">
                                        <a class="animsition-link" href="">
                                            <span class="site-menu-title">Portaria</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('portal.condominium.security-cam.index') }}">
                                            <span class="site-menu-title">Câmeras de Segurança</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">Integrantes</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('portal.condominium.user.index') }}">
                                            <span class="site-menu-title">Integrantes</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('portal.condominium.group.index') }}">
                                            <span class="site-menu-title">Grupos</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item none">
                                        <a class="animsition-link" href="">
                                            <span class="site-menu-title">Visitantes</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item none">
                                        <a class="animsition-link" href="">
                                            <span class="site-menu-title">Comissões</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">Fornecedores</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('portal.condominium.provider.index') }}">
                                            <span class="site-menu-title">Fornecedores</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('portal.condominium.provider.category.index') }}">
                                            <span class="site-menu-title">Categorias</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon icon wb-users" aria-hidden="true"></i>
                            <span class="site-menu-title">Administrar</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('portal.manage.contracts.index') }}">
                                    <span class="site-menu-title">Contratos</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('portal.manage.maintenance.index') }}">
                                    <span class="site-menu-title">Manutenções Preventivas</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('portal.manage.reserve-areas.index') }}">
                                    <span class="site-menu-title">Recursos Comuns</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- active open -->
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon icon wb-chat-group" aria-hidden="true"></i>
                            <span class="site-menu-title">Comunicação</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item active">
                                <a class="animsition-link active" href="{{ route('portal.communication.message.public.index') }}">
                                    <span class="site-menu-title">Mensagens Públicas</span>
                                </a>
                            </li>
                            <li class="site-menu-item none">
                                <a class="animsition-link" href="{{ route('portal.communication.message.private.index') }}">
                                    <span class="site-menu-title">Mensagens Privadas</span>
                                </a>
                            </li>
                            <li class="site-menu-item none">
                                <a class="animsition-link" href="">
                                    <span class="site-menu-title">Eventos</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('portal.communication.called.index') }}">
                                    <span class="site-menu-title">Meus Chamados</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('portal.communication.called.category.index') }}">
                                    <span class="site-menu-title">Categoria Chamados</span>
                                </a>
                            </li>
                            <li class="site-menu-item none">
                                <a class="animsition-link" href="">
                                    <span class="site-menu-title">Fórum</span>
                                </a>
                            </li>
                            <li class="site-menu-item none">
                                <a class="animsition-link" href="">
                                    <span class="site-menu-title">Assembleias</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('portal.communication.communication.index') }}">
                                    <span class="site-menu-title">Comunicados</span>
                                </a>
                            </li>
                            <li class="site-menu-item none">
                                <a class="animsition-link" href="">
                                    <span class="site-menu-title">Achados e Perdidos</span>
                                </a>
                            </li>
                            <li class="site-menu-item none">
                                <a class="animsition-link" href="">
                                    <span class="site-menu-title">Enquetes</span>
                                </a>
                            </li>
                            <li class="site-menu-item none">
                                <a class="animsition-link" href="">
                                    <span class="site-menu-title">Álbum de Fotos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub none">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                            <span class="site-menu-title">Arquivos</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">Panel</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="../uikit/panel-structure.html">
                                            <span class="site-menu-title">Panel Structure</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="../uikit/panel-actions.html">
                                            <span class="site-menu-title">Panel Actions</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="../uikit/panel-portlets.html">
                                            <span class="site-menu-title">Panel Portlets</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/buttons.html">
                                    <span class="site-menu-title">Buttons</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/dropdowns.html">
                                    <span class="site-menu-title">Dropdowns</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/icons.html">
                                    <span class="site-menu-title">Icons</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/list.html">
                                    <span class="site-menu-title">List</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/tooltip-popover.html">
                                    <span class="site-menu-title">Tooltip &amp; Popover</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/modals.html">
                                    <span class="site-menu-title">Modals</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/tabs-accordions.html">
                                    <span class="site-menu-title">Tabs &amp; Accordions</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/images.html">
                                    <span class="site-menu-title">Images</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/badges-labels.html">
                                    <span class="site-menu-title">Badges &amp; Labels</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/progress-bars.html">
                                    <span class="site-menu-title">Progress Bars</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/carousel.html">
                                    <span class="site-menu-title">Carousel</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/typography.html">
                                    <span class="site-menu-title">Typography</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/colors.html">
                                    <span class="site-menu-title">Colors</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../uikit/utilities.html">
                                    <span class="site-menu-title">Utilties</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub none">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                            <span class="site-menu-title">Administrar</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item hidden-xs site-tour-trigger">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">Tour</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/animation.html">
                                    <span class="site-menu-title">Animation</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/highlight.html">
                                    <span class="site-menu-title">Highlight</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/lightbox.html">
                                    <span class="site-menu-title">Lightbox</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/scrollable.html">
                                    <span class="site-menu-title">Scrollable</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/rating.html">
                                    <span class="site-menu-title">Rating</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/context-menu.html">
                                    <span class="site-menu-title">Context Menu</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/alertify.html">
                                    <span class="site-menu-title">Alertify</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/masonry.html">
                                    <span class="site-menu-title">Masonry</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/treeview.html">
                                    <span class="site-menu-title">Treeview</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/toastr.html">
                                    <span class="site-menu-title">Toastr</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/maps-vector.html">
                                    <span class="site-menu-title">Vector Maps</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/maps-google.html">
                                    <span class="site-menu-title">Google Maps</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/sortable-nestable.html">
                                    <span class="site-menu-title">Sortable &amp; Nestable</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../advanced/bootbox-sweetalert.html">
                                    <span class="site-menu-title">Bootbox &amp; Sweetalert</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub none">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                            <span class="site-menu-title">Financeiro</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/alerts.html">
                                    <span class="site-menu-title">Alerts</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/ribbon.html">
                                    <span class="site-menu-title">Ribbon</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/pricing-tables.html">
                                    <span class="site-menu-title">Pricing Tables</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/overlay.html">
                                    <span class="site-menu-title">Overlay</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/cover.html">
                                    <span class="site-menu-title">Cover</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/timeline-simple.html">
                                    <span class="site-menu-title">Simple Timeline</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/timeline.html">
                                    <span class="site-menu-title">Timeline</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/step.html">
                                    <span class="site-menu-title">Step</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/comments.html">
                                    <span class="site-menu-title">Comments</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/media.html">
                                    <span class="site-menu-title">Media</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/chat.html">
                                    <span class="site-menu-title">Chat</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/testimonials.html">
                                    <span class="site-menu-title">Testimonials</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/nav.html">
                                    <span class="site-menu-title">Nav</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/navbars.html">
                                    <span class="site-menu-title">Navbars</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/blockquotes.html">
                                    <span class="site-menu-title">Blockquotes</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/pagination.html">
                                    <span class="site-menu-title">Pagination</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../structure/breadcrumbs.html">
                                    <span class="site-menu-title">Breadcrumbs</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub none">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                            <span class="site-menu-title">Relatórios</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../widgets/statistics.html">
                                    <span class="site-menu-title">Statistics Widgets</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../widgets/data.html">
                                    <span class="site-menu-title">Data Widgets</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../widgets/blog.html">
                                    <span class="site-menu-title">Blog Widgets</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../widgets/chart.html">
                                    <span class="site-menu-title">Chart Widgets</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../widgets/social.html">
                                    <span class="site-menu-title">Social Widgets</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../widgets/weather.html">
                                    <span class="site-menu-title">Weather Widgets</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub none">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                            <span class="site-menu-title">Sistema</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/general.html">
                                    <span class="site-menu-title">General Elements</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/material.html">
                                    <span class="site-menu-title">Material Elements</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/advanced.html">
                                    <span class="site-menu-title">Advanced Elements</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/layouts.html">
                                    <span class="site-menu-title">Form Layouts</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/wizard.html">
                                    <span class="site-menu-title">Form Wizard</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/validation.html">
                                    <span class="site-menu-title">Form Validation</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/masks.html">
                                    <span class="site-menu-title">Form Masks</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/editable.html">
                                    <span class="site-menu-title">Form Editable</span>
                                </a>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">Editors</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="../forms/editor-summernote.html">
                                            <span class="site-menu-title">Summernote</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="../forms/editor-markdown.html">
                                            <span class="site-menu-title">Markdown</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="../forms/editor-ace.html">
                                            <span class="site-menu-title">Ace Editor</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/image-cropping.html">
                                    <span class="site-menu-title">Image Cropping</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="../forms/file-uploads.html">
                                    <span class="site-menu-title">File Uploads</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--
                <div class="site-menubar-section">
                    <h5>
                        Perfil
                        <span class="pull-right">30%</span>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar active" style="width: 30%;" role="progressbar"></div>
                    </div>
                    <h5>
                        Condomínio
                        <span class="pull-right">60%</span>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-warning" style="width: 60%;" role="progressbar"></div>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
    <div class="site-menubar-footer">
        <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
           data-original-title="Configurações">
            <span class="icon md-settings" aria-hidden="true"></span>
        </a>
        <a href="{{ route('auth.logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Sair">
            <span class="icon md-power" aria-hidden="true"></span>
        </a>
    </div>
</div>
<div class="site-gridmenu">
    <div>
        <div>
            <ul>
                <li>
                    <a href="../apps/mailbox/mailbox.html">
                        <i class="icon wb-envelope"></i>
                        <span>Mailbox</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/calendar/calendar.html">
                        <i class="icon wb-calendar"></i>
                        <span>Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/contacts/contacts.html">
                        <i class="icon wb-user"></i>
                        <span>Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/media/overview.html">
                        <i class="icon wb-camera"></i>
                        <span>Media</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/documents/categories.html">
                        <i class="icon wb-order"></i>
                        <span>Documents</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/projects/projects.html">
                        <i class="icon wb-image"></i>
                        <span>Project</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/forum/forum.html">
                        <i class="icon wb-chat-group"></i>
                        <span>Forum</span>
                    </a>
                </li>
                <li>
                    <a href="../index.html">
                        <i class="icon wb-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
    @endif