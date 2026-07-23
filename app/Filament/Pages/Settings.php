<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Situs';

    protected static ?string $title = 'Pengaturan Situs';

    protected static string $view = 'filament.pages.settings';

    /**
     * @var array<string, mixed>
     */
    public array $data = [];

    protected const KEYS = [
        'site_name', 'site_logo',
        'wa_number', 'wa_template',
        'address', 'hours',
        'facebook_url', 'instagram_url', 'tiktok_url', 'map_embed',
        'about_title', 'about_text', 'about_image',
    ];

    public function mount(): void
    {
        $values = [];

        foreach (self::KEYS as $key) {
            $values[$key] = Setting::get($key);
        }

        $this->form->fill($values);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Settings')
                    ->tabs([
                        Tab::make('Umum')
                            ->schema([
                                TextInput::make('site_name')
                                    ->label('Nama Situs')
                                    ->maxLength(255),
                                FileUpload::make('site_logo')
                                    ->label('Logo')
                                    ->image()
                                    ->directory('settings'),
                            ]),
                        Tab::make('Kontak & Lokasi')
                            ->schema([
                                TextInput::make('wa_number')
                                    ->label('Nomor WhatsApp Tujuan Pemesanan')
                                    ->placeholder('62812xxxxxxx')
                                    ->helperText('Format internasional tanpa tanda + atau 0 di depan, contoh: 6281234567890'),
                                TextInput::make('address')
                                    ->label('Alamat'),
                                TextInput::make('hours')
                                    ->label('Jam Operasional')
                                    ->placeholder('Senin - Sabtu, 08.00 - 17.00'),
                                TextInput::make('facebook_url')
                                    ->label('Link Facebook')
                                    ->url(),
                                TextInput::make('instagram_url')
                                    ->label('Link Instagram')
                                    ->url(),
                                TextInput::make('tiktok_url')
                                    ->label('Link TikTok')
                                    ->url(),
                                Textarea::make('map_embed')
                                    ->label('Embed Google Maps (iframe)')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Template WhatsApp')
                            ->schema([
                                Textarea::make('wa_template')
                                    ->label('Template Pesan Otomatis')
                                    ->rows(4)
                                    ->helperText('Gunakan placeholder {produk} dan {jumlah}. Contoh: Halo, saya ingin memesan {produk} sebanyak {jumlah}.')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Tentang Desa')
                            ->schema([
                                TextInput::make('about_title')
                                    ->label('Judul'),
                                Textarea::make('about_text')
                                    ->label('Teks Profil Desa & Produk')
                                    ->rows(6)
                                    ->columnSpanFull(),
                                FileUpload::make('about_image')
                                    ->label('Gambar')
                                    ->image()
                                    ->directory('settings'),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach (self::KEYS as $key) {
            Setting::set($key, is_array($state[$key] ?? null) ? json_encode($state[$key]) : ($state[$key] ?? null));
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
