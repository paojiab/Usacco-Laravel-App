<x-main>
    <section class="container mt-5">
        @if ($account->status == 'pending')
        <div class="alert alert-primary" role="alert">
          Your account is pending verification, keep around!
        </div>
        @elseif ($account->status == 'rejected')
        <div class="alert alert-danger" role="alert">
          Your account has been rejected! Contact us for help.
        </div>
      @elseif ($account->status == 'verified')
          <livewire:savings.hero :account="$account"/>
          <livewire:savings-statement :account="$account">
</div>
      @endif
      </section>
</x-main>
