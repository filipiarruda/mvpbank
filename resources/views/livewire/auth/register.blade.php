<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Crie sua conta agora mesmo')" :description="__('Preencha os campos e comece a usar sua conta!')" />

    <!-- Status da Sessão -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit.prevent="register" class="flex flex-col gap-6">
        <!-- Nome Completo -->
        <flux:input
            wire:model.defer="name"
            :label="__('Nome Completo')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nome Completo')"
        />

        <!-- E-mail -->
        <flux:input
            wire:model.defer="email"
            :label="__('E-mail')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Senha -->
        <flux:input
            wire:model.defer="password"
            :label="__('Senha')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Senha')"
        />

        <!-- Confirmação de Senha -->
        <flux:input
            wire:model.defer="password_confirmation"
            :label="__('Confirmação de Senha')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirmação de Senha')"
        />

        <!-- Tipo de Conta -->
        <flux:select wire:model.live="type" placeholder="Tipo de conta" :label="__('Tipo de Conta')">
            <flux:select.option value="individual">{{ __('Conta Pessoa Física') }}</flux:select.option>
            <flux:select.option value="bussiness">{{ __('Conta PJ') }}</flux:select.option>
        </flux:select>

        <flux:input wire:model="mobile_phone" label="Telefone" type="text" placeholder="(99) 99999-9999" required />
        <!-- Campos dinâmicos -->
        @if ($type === 'individual')
            <flux:input wire:model="cpf" label="CPF" type="text" placeholder="000.000.000-00" required />
            <flux:input wire:model="birthdate" label="Data de Nascimento" type="date" required />
        @elseif ($type === 'bussiness')
            <flux:input wire:model="cnpj" label="CNPJ" type="text" placeholder="00.000.000/0000-00" required />
        @endif

        <!-- Botão de Envio -->
        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Criar conta') }}
            </flux:button>
        </div>
    </form>

    <!-- Link para Login -->
    <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Já tem uma conta?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Entrar') }}</flux:link>
    </div>
</div>
