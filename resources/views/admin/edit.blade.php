@extends('layouts.app')

@section('title', 'Edit User — Admin E-PKS')

@section('content')
<div class="bg-kej-bg min-h-screen py-6 sm:py-10">
    <div class="max-w-[800px] mx-auto px-4 sm:px-6">
        <div class="mb-8 animate-fade-in">
            <a href="{{ route('admin.index') }}" class="text-[12px] sm:text-[13px] font-bold text-kej-muted hover:text-kej-navy flex items-center gap-2 mb-4 group transition-colors">
                <div class="p-1.5 bg-white border border-kej-border rounded-lg group-hover:border-kej-navy transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                </div>
                Kembali ke Daftar User
            </a>
            <div class="flex justify-between items-end mb-1 sm:mb-2">
                <div class="text-[10px] sm:text-[11px] font-extrabold text-kej-gold-dark tracking-[0.2em] uppercase">Update Informasi</div>
                <a href="{{ route('admin.export.pks02', $user) }}" class="flex items-center gap-2 text-[10px] sm:text-[11px] font-black text-kej-navy bg-white border border-kej-border px-3 py-1.5 rounded-lg hover:bg-kej-navy hover:text-white transition-all shadow-sm">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    EXPORT PKS-02
                </a>
            </div>
            <h1 class="font-serif text-2xl sm:text-3xl font-black text-kej-navy leading-tight">Edit Data <span class="text-kej-green">User</span></h1>
        </div>

        @if(session('success'))
        <div class="bg-kej-green/10 border border-kej-green text-kej-green px-4 py-3 rounded-xl mb-6 text-sm font-bold flex items-center gap-2 animate-fade-in">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <div x-data="{ activeTab: 'profiling', maritalStatus: '{{ old('marital_status', $user->marital_status) }}' }" class="bg-white border border-kej-border rounded-2xl overflow-hidden shadow-sm">
            <div class="flex flex-col sm:flex-row border-b border-kej-border bg-kej-bg/30">
                <button @click="activeTab = 'profiling'" type="button" :class="activeTab === 'profiling' ? 'bg-white text-kej-navy border-b-2 border-b-kej-navy' : 'text-kej-muted hover:text-kej-navy hover:bg-kej-bg'" class="flex-1 py-3 px-2 sm:px-4 font-black text-[9px] sm:text-[10px] uppercase tracking-widest transition-colors flex flex-col items-center justify-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    I. Identitas
                </button>
                <button @click="activeTab = 'background'" type="button" :class="activeTab === 'background' ? 'bg-white text-kej-navy border-b-2 border-b-kej-navy' : 'text-kej-muted hover:text-kej-navy hover:bg-kej-bg'" class="flex-1 py-3 px-2 sm:px-4 font-black text-[9px] sm:text-[10px] uppercase tracking-widest transition-colors flex flex-col items-center justify-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    II. Latar Belakang
                </button>
                <button @click="activeTab = 'family'" type="button" :class="activeTab === 'family' ? 'bg-white text-kej-navy border-b-2 border-b-kej-navy' : 'text-kej-muted hover:text-kej-navy hover:bg-kej-bg'" class="flex-1 py-3 px-2 sm:px-4 font-black text-[9px] sm:text-[10px] uppercase tracking-widest transition-colors flex flex-col items-center justify-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    III. Keluarga
                </button>
                <button @click="activeTab = 'environment'" type="button" :class="activeTab === 'environment' ? 'bg-white text-kej-navy border-b-2 border-b-kej-navy' : 'text-kej-muted hover:text-kej-navy hover:bg-kej-bg'" class="flex-1 py-3 px-2 sm:px-4 font-black text-[9px] sm:text-[10px] uppercase tracking-widest transition-colors flex flex-col items-center justify-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    IV & V. Lingkungan
                </button>
                <button @click="activeTab = 'work_capability'" type="button" :class="activeTab === 'work_capability' ? 'bg-white text-kej-navy border-b-2 border-b-kej-navy' : 'text-kej-muted hover:text-kej-navy hover:bg-kej-bg'" class="flex-1 py-3 px-2 sm:px-4 font-black text-[9px] sm:text-[10px] uppercase tracking-widest transition-colors flex flex-col items-center justify-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    VI. Kemampuan
                </button>
                <button @click="activeTab = 'pendapat'" type="button" :class="activeTab === 'pendapat' ? 'bg-white text-kej-navy border-b-2 border-b-kej-gold-dark' : 'text-kej-muted hover:text-kej-navy hover:bg-kej-bg'" class="flex-1 py-3 px-2 sm:px-4 font-black text-[9px] sm:text-[10px] uppercase tracking-widest transition-colors flex flex-col items-center justify-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    Pendapat Hukum
                </button>
            </div>

            <form action="{{ route('admin.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                {{-- TAB 1: PROFILING --}}
                <div x-show="activeTab === 'profiling'" class="p-8 space-y-6">
                    <div class="mb-6 pb-2 border-b border-kej-border">
                        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">A. Identitas Diri Terpidana</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                        <div>
                            <label for="national_id" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">NIK</label>
                            <input type="text" id="national_id" name="national_id" value="{{ old('national_id', $user->national_id) }}" maxlength="16"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="place_of_birth" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Tempat Lahir</label>
                            <input type="text" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $user->place_of_birth) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                        <div>
                            <label for="date_of_birth" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Tanggal Lahir</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="gender" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Jenis Kelamin</label>
                            <select id="gender" name="gender"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('gender', $user->gender) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $user->gender) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="religion" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Agama</label>
                            <select id="religion" name="religion"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam" {{ old('religion', $user->religion) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('religion', $user->religion) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('religion', $user->religion) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('religion', $user->religion) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('religion', $user->religion) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('religion', $user->religion) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                        <div>
                            <label for="nationality" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Kewarganegaraan</label>
                            <input type="text" id="nationality" name="nationality" value="{{ old('nationality', $user->nationality) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="marital_status" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Status Perkawinan</label>
                            <select id="marital_status" name="marital_status" x-model="maritalStatus" x-init="maritalStatus = '{{ old('marital_status', $user->marital_status) }}'"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                                <option value="">-- Pilih Status --</option>
                                <option value="belum_menikah" {{ old('marital_status', $user->marital_status) === 'belum_menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="menikah" {{ old('marital_status', $user->marital_status) === 'menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="cerai" {{ old('marital_status', $user->marital_status) === 'cerai' ? 'selected' : '' }}>Cerai</option>
                            </select>
                        </div>
                        <div x-show="maritalStatus === 'menikah'">
                            <label for="spouse_name" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Pasangan</label>
                            <input type="text" id="spouse_name" name="spouse_name" value="{{ old('spouse_name', $user->spouse_name) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="dependents_count" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Jumlah Tanggungan</label>
                            <input type="number" id="dependents_count" name="dependents_count" value="{{ old('dependents_count', $user->dependents_count) }}" min="0"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                        <div>
                            <label for="children_count" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Jumlah Anak</label>
                            <input type="number" id="children_count" name="children_count" value="{{ old('children_count', $user->children_count) }}" min="0"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="education" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Pendidikan Terakhir</label>
                            <input type="text" id="education" name="education" value="{{ old('education', $user->education) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                        <div>
                            <label for="occupation" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Pekerjaan</label>
                            <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $user->occupation) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="address" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Tempat Tinggal / Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="2"
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label for="ktp_address" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Alamat KTP (Jika Berbeda)</label>
                        <textarea id="ktp_address" name="ktp_address" rows="2"
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('ktp_address', $user->ktp_address) }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label for="phone_number" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Nomor Telepon / HP</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                            class="w-full md:w-1/2 px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                    </div>

                    <div class="mb-6 mt-10 pb-2 border-b border-kej-border">
                        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">B. Informasi Perkara & Penempatan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="placement_id" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Satker Yang Menangani</label>
                            <select id="placement_id" name="placement_id"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                                <option value="">-- Pilih Satker --</option>
                                @foreach($placements as $placement)
                                    <option value="{{ $placement->id }}" {{ old('placement_id', $user->placement_id) == $placement->id ? 'selected' : '' }}>
                                        {{ $placement->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="crime" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Perkara / Kejahatan</label>
                            <input type="text" id="crime" name="crime" value="{{ old('crime', $user->crime) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="sentence" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Masa Hukuman (Vonis)</label>
                        <textarea id="sentence" name="sentence" rows="2"
                            class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('sentence', $user->sentence) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="pasal" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Pasal KUHP / UU</label>
                            <input type="text" id="pasal" name="pasal" value="{{ old('pasal', $user->pasal) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold" placeholder="Contoh: Pasal 362">
                        </div>
                        <div>
                            <label for="sub_pasal" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Sub Pasal / Ayat</label>
                            <input type="text" id="sub_pasal" name="sub_pasal" value="{{ old('sub_pasal', $user->sub_pasal) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold" placeholder="Contoh: Ayat 1">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="jenis_tindak_pidana" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Jenis Tindak Pidana</label>
                            <input type="text" id="jenis_tindak_pidana" name="jenis_tindak_pidana" value="{{ old('jenis_tindak_pidana', $user->jenis_tindak_pidana) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold" placeholder="Contoh: Pencurian">
                        </div>
                        <div>
                            <label for="sentence_hours" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Target Jam Kerja Sosial</label>
                            <input type="number" id="sentence_hours" name="sentence_hours" value="{{ old('sentence_hours', $user->sentence_hours) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold" placeholder="Contoh: 240">
                        </div>
                    </div>

                    <div class="mb-6 mt-10 pb-2 border-b border-kej-border">
                        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">C. Akses Sistem E-PKS</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                        <div>
                            <label for="role" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Role Sistem</label>
                            <select id="role" name="role" required
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                                <option value="pidana" {{ $user->role === 'pidana' ? 'selected' : '' }}>Terpidana</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin Kejaksaan</option>
                                <option value="jaksa_pengawas" {{ $user->role === 'jaksa_pengawas' ? 'selected' : '' }}>Jaksa Pengawas</option>
                            </select>
                        </div>
                    </div>

                    @if($user->role === 'pidana')
                    <div class="mb-6 mt-10 pb-2 border-b border-kej-border">
                        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">D. Jaksa Pengawas (Assignment)</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jaksa_ids" class="block text-[10px] font-bold text-kej-navy uppercase tracking-widest mb-2">Pilih Jaksa Pengawas</label>
                            <select id="jaksa_ids" name="jaksa_ids[]" multiple
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold h-32 scrollbar-hide">
                                @foreach($jaksas as $jaksa)
                                    <option value="{{ $jaksa->id }}" {{ $user->assignedJaksa->contains($jaksa->id) ? 'selected' : '' }}>
                                        {{ $jaksa->name }} ({{ $jaksa->role }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-[9px] text-kej-muted mt-2 font-bold uppercase italic tracking-tighter">Tekan CTRL + Klik untuk memilih lebih dari satu Jaksa.</p>
                        </div>
                    </div>
                    @endif

                    <div class="pt-6 border-t border-kej-border flex flex-col sm:flex-row justify-end gap-4">
                        <button type="submit" class="w-full sm:w-auto bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg hover:bg-kej-green transition-all transform hover:-translate-y-0.5 active:scale-95">
                            Simpan Data Profiling
                        </button>
                    </div>
                </div>

                @include('admin.users.tabs.background')
                @include('admin.users.tabs.family')
                @include('admin.users.tabs.environment')
                @include('admin.users.tabs.work_capability')

                {{-- TAB 6: PENDAPAT HUKUM --}}
                <div x-show="activeTab === 'pendapat'" style="display: none;" class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="pks02_prosecutor_name" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Jaksa Penuntut Umum</label>
                            <input type="text" id="pks02_prosecutor_name" name="pks02_prosecutor_name" value="{{ old('pks02_prosecutor_name', $user->pks02_prosecutor_name) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                        <div>
                            <label for="pks02_case_number" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Nomor Perkara / Register</label>
                            <input type="text" id="pks02_case_number" name="pks02_case_number" value="{{ old('pks02_case_number', $user->pks02_case_number) }}"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="pks02_opinion_analysis" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Analisis & Pendapat Hukum</label>
                            <textarea id="pks02_opinion_analysis" name="pks02_opinion_analysis" rows="4"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_opinion_analysis', $user->pks02_opinion_analysis) }}</textarea>
                        </div>
                        <div>
                            <label for="pks02_opinion_recommendation" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Rekomendasi Tindakan</label>
                            <textarea id="pks02_opinion_recommendation" name="pks02_opinion_recommendation" rows="3"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_opinion_recommendation', $user->pks02_opinion_recommendation) }}</textarea>
                        </div>
                        <div>
                            <label for="pks02_opinion_conclusion" class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Kesimpulan Akhir</label>
                            <textarea id="pks02_opinion_conclusion" name="pks02_opinion_conclusion" rows="2"
                                class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">{{ old('pks02_opinion_conclusion', $user->pks02_opinion_conclusion) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Rekomendasi Kelayakan PKS</label>
                            <select name="pks02_profiling_meta[recommendation]" class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold appearance-none">
                                <option value="">-- Pilih Rekomendasi --</option>
                                @foreach(['Layak', 'Kurang Layak', 'Tidak Layak'] as $val)
                                <option value="{{ $val }}" {{ old('pks02_profiling_meta.recommendation', $user->pks02_profiling_meta['recommendation'] ?? '') === $val ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-6 mt-10 pb-2 border-b border-kej-border">
                        <h3 class="text-xs font-black text-kej-navy uppercase tracking-widest">VIII. Metadata Profiling</h3>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Sumber Data Profiling</label>
                            <div class="flex flex-wrap gap-4">
                                @php $sources = is_array(old('pks02_profiling_meta.data_sources', $user->pks02_profiling_meta['data_sources'] ?? [])) ? old('pks02_profiling_meta.data_sources', $user->pks02_profiling_meta['data_sources'] ?? []) : []; @endphp
                                @foreach(['Wawancara', 'BAP', 'Saksi', 'Intelijen', 'Litmas', 'Dukcapil', 'Observasi', 'Lainnya'] as $val)
                                <label class="flex items-center gap-2 text-sm font-semibold text-kej-navy">
                                    <input type="checkbox" name="pks02_profiling_meta[data_sources][]" value="{{ $val }}" {{ in_array($val, $sources) ? 'checked' : '' }} class="text-kej-green focus:ring-kej-green rounded">
                                    {{ $val }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Tanggal Pelaksanaan Profiling</label>
                                <input type="date" name="pks02_profiling_meta[profiling_date]" value="{{ old('pks02_profiling_meta.profiling_date', $user->pks02_profiling_meta['profiling_date'] ?? '') }}"
                                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-kej-navy uppercase tracking-widest mb-2">Nama Petugas Profiling</label>
                                <input type="text" name="pks02_profiling_meta[profiling_officer]" value="{{ old('pks02_profiling_meta.profiling_officer', $user->pks02_profiling_meta['profiling_officer'] ?? '') }}"
                                    class="w-full px-4 py-3 bg-kej-bg border border-kej-border rounded-xl text-sm focus:outline-none focus:border-kej-green transition-all font-semibold">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-kej-border flex flex-col sm:flex-row justify-end gap-4">
                        <button type="submit" class="w-full sm:w-auto bg-kej-navy text-white px-10 py-4 rounded-xl font-black text-sm tracking-widest uppercase shadow-lg hover:bg-kej-green transition-all transform hover:-translate-y-0.5 active:scale-95">
                            Simpan Pendapat Hukum
                        </button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection
