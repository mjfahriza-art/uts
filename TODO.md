# TODO

## Membership Status Pricing (Gold / Silver / Bronze)

- [x] Analyze membership module files
- [x] Get plan approved by user

### Implementation Steps
- [x] Replace free-text "Paket" input with Gold/Silver/Bronze dropdown in `form.blade.php`
- [x] Add JS auto price calculation (Gold 1jt/bln & 12jt/thn, Silver 500K/bln & 6jt/thn, Bronze 300K/bln & 3,6jt/thn)
- [x] Make price field read-only
- [x] Add price reference helper text under Paket select
- [x] Update `MembershipFactory.php` sample packages to Gold/Silver/Bronze
- [x] Add server-side `calculatePrice()` in `MembershipController.php` (store & update)

### Testing
- [x] PHP syntax check passed for controller & factory
- [ ] Refresh Tambah/Edit Membership page and verify auto price calculation
