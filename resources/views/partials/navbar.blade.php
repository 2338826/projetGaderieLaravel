<nav>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') || request()->is('nurseries*') ? 'active' : '' }}"
                href="{{ url('/') }}">Garderies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'expense.show' ? 'active' : '' }}"
                href="{{ route('expense.show') }}">Dépenses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('commerces') ? 'active' : '' }}"
                href="{{ url('/commerces') }}">Commerces</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('categorie-depense') ? 'active' : '' }}"
                href="{{ url('/categorie-depense') }}">Catégorie de dépense</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('enfants') ? 'active' : '' }}" href="{{ url('/enfants') }}">Enfants</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('educateurs') ? 'active' : '' }}"
                href="{{ url('/educateurs') }}">Éducateurs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('presences') ? 'active' : '' }}"
                href="{{ url('/presences') }}">Présences</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('rapport') ? 'active' : '' }}" href="{{ url('/rapport') }}">Rapport</a>
        </li>
    </ul>
</nav>