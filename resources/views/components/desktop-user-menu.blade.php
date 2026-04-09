@php
    $user = auth()->user();
    $initials = '';

    if ($user) {
        if (method_exists($user, 'initials')) {
            $initials = $user->initials();
        } elseif (property_exists($user, 'name')) {
            $names = explode(' ', $user->name);
            foreach ($names as $n) {
                $initials .= strtoupper(substr($n, 0, 1));
            }
        }
    }
@endphp

<span>{{ $initials ?: 'U' }}</span>

<flux:dropdown position="bottom" align="start">
    <flux:sidebar.profile
        :name="$user?->name ?? 'Guest'"
        :initials="$initials"
        icon:trailing="chevrons-up-down"
        data-test="sidebar-menu-button"
    />

    <flux:menu>
        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
            <flux:avatar
                :name="$user?->name ?? 'Guest'"
                :initials="$initials"
            />
            <div class="grid flex-1 text-start text-sm leading-tight">
                <flux:heading class="truncate">{{ $user?->name ?? 'Guest' }}</flux:heading>
                <flux:text class="truncate">{{ $user?->email ?? '' }}</flux:text>
            </div>
        </div>
        <flux:menu.separator />
        <flux:menu.radio.group>
            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                {{ __('Settings') }}
            </flux:menu.item>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer"
                    data-test="logout-button"
                >
                    {{ __('Log out') }}
                </flux:menu.item>
            </form>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>