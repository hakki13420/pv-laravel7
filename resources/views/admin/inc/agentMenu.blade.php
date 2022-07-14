<li class="nav-item has-treeview">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-user-cog"></i>
    <p>
        المتعامل الاقتصادي
    </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <router-link :to="{name:'commercants'}" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                    التاجر
                </p>
            </router-link>
        </li>

        <li class="nav-item ">
            <router-link  :to="{name:'activites'}" class="nav-link">
                <i class="nav-icon fas fa-image"></i>
                <p>
                    النشاطات التجارية
                </p>
            </router-link>
        </li>


    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-sticky-note"></i>
        <p>
            المحاضر الرسمية
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <router-link  :to="{name:'pvs'}" class="nav-link">
                <i class="nav-icon fas fa-sticky-note"></i>
                <p>
                    المحاضر
                </p>
            </router-link>
        </li>

        <li class="nav-item ">
            <router-link  :to="{name:'infractions'}" class="nav-link">
                <i class="nav-icon fas fa-bug"></i>
                <p>
                    المخالفات
                </p>
            </router-link>
        </li>

        <li class="nav-item ">
            <router-link :to="{name:'model_redaction'}" class="nav-link">
                <i class="nav-icon fab fa-buromobelexperte"></i>
                <p>
                    نمادج التحرير
                </p>
            </router-link>
        </li>


    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link active">
    <i class="nav-icon fas fa-users"></i>
    <p>
        إدارة المستخدمين
    </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item ">
            <router-link :to="{name:'users'}" class="nav-link disabled">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    المستخدمبن
                </p>
            </router-link>
        </li>
        <li class="nav-item ">
            <router-link  :to="{name:'grades'}" class="nav-link disabled">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                    الرتب
                </p>
            </router-link>
        </li>

        <li class="nav-item ">
            <router-link :to="{name:'brigades'}" class="nav-link disabled">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                    فرق التفتيش
                </p>
            </router-link>
        </li>


    </ul>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            الإحصاءات
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item ">
            <router-link :to="{name:'statistiques'}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    الإحصاءات
                </p>
            </router-link>
        </li>


    </ul>
</li>


<li class="nav-item has-treeview">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-cubes"></i>
        <p>        الحجز
    </p>
</a>
<ul class="nav nav-treeview">

    <li class="nav-item ">
        <router-link :to="{name:'tsaisies'}" class="nav-link">
            <i class="nav-icon fas fa-cubes"></i>
            <p>
                الحجز
            </p>
        </router-link>
    </li>


    <li class="nav-item ">
        <router-link :to="{name:'products'}" class="nav-link">
            <i class="nav-icon fab fa-product-hunt"></i>
            <p>
                مواد الحجز
            </p>
        </router-link>
    </li>
    <li class="nav-item ">
        <router-link :to="{name:'categories'}" class="nav-link">
            <i class="nav-icon fas fa-window-restore"></i>
            <p>
                طبيعة المواد المحجوزة
            </p>
        </router-link>
    </li>

    <li class="nav-item ">
        <router-link :to="{name:'typesaisies'}" class="nav-link">
            <i class="nav-icon fas fa-vector-square"></i>
            <p>
                أنواع الحجز
            </p>
        </router-link>
    </li>
</ul>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link active disabled">
        <i class="nav-icon fas fa-tools"></i>
        <p>
            الإعدادات
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item ">
            <router-link :to="{name:'configuration'}" class="nav-link disabled">
                <i class="nav-icon fas fa-tools"></i>
                <p>
                    الإعدادات
                </p>
            </router-link>
        </li>


        <li class="nav-item ">
            <router-link :to="{name:'communes'}" class="nav-link disabled">
                <i class="nav-icon fas fa-city"></i>
                <p>
                    البلديات
                </p>
            </router-link>
        </li>

        <li class="nav-item ">
            <router-link :to="{name:'services'}" class="nav-link disabled">
                <i class="nav-icon fas fa-vector-square"></i>
                <p>
                    المصالح
                </p>
            </router-link>
        </li>
        <li class="nav-item ">
            <router-link :to="{name:'exercices'}" class="nav-link disabled">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                    السنة المالية
                </p>
            </router-link>
        </li>

    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
    class="nav-link">
        <i class="nav-icon fas fa-power-off"></i>
        <p>تسجيل الخروج</p>
    </a>
</li>

 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
