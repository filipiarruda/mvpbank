<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Crie sua conta agora mesmo')" :description="__('Preencha os campos e comece a usar sua conta!')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Nome Completo')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nome Completo')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('E-mail')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Senha')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Senha')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirmação de Senha')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirmação de Senha')"
        />

        <flux:select wire:model="type" placeholder="Tipo de conta" :label="__('Tipo de Conta')">
            <flux:select.option value="people">Conta Pessoa Física</flux:select.option>
            <flux:select.option value="company">Conta PJ</flux:select.option>
        </flux:select>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full" >
                {{ __('Criar conta') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
