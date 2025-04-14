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
            <a class="nav-link {{ Route::currentRouteName() == 'commerce.show' ? 'active' : '' }}"
                href="{{ route('commerce.show') }}">Commerces</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'expenseCategory.show' ? 'active' : '' }}"
                href="{{ route('expenseCategory.show') }}">Catégorie de dépense</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'child.show' ? 'active' : '' }}"
                href="{{route('child.show') }}">Enfants</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'educator.show' ? 'active' : '' }}"
                href="{{route('educator.show') }}">Educateurs</a>
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