<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin Dashboard | YouCode Sprint</title>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeInUp 0.6s ease-out forwards; }

        .glass-card {
            background: rgba(5, 5, 5, 0.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(34, 211, 238, 0.2);
        }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #050505; }
        ::-webkit-scrollbar-thumb { background: #22d3ee; border-radius: 10px; }

        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        .group-hover\:animate-\[shimmer_2s_infinite\]:hover {
            animation: shimmer 2s infinite;
        }
    </style>
</head>
<body class="bg-cyan-900 bg-cover bg-center bg-no-repeat min-h-screen font-sans text-white overflow-hidden">

<div class="flex h-screen overflow-hidden">

    <aside class="w-72 glass-card m-4 rounded-[2rem] hidden md:flex flex-col p-6 animate-fade-in">
        <header class="text-center mb-12">
            <h1 class="text-white text-2xl font-black italic uppercase tracking-tighter">
                YouCode <br>
                <span class="text-cyan-400 inline-block ml-[15%]">Sprint</span>
            </h1>
            <div class="h-[2px] w-[40%] bg-cyan-500 mx-auto mt-2 rounded-full"></div>
        </header>

        <nav class="flex-1 space-y-4">
            <a href="#overview" class="flex items-center space-x-4 text-cyan-400 bg-white/5 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all">
                <i class="fas fa-th-large"></i>
                <span>Overview</span>
            </a>
            <a href="#users" class="flex items-center space-x-4 text-white/60 hover:text-cyan-400 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-white/5">
                <i class="fas fa-users"></i>
                <span>Utilisateurs</span>
            </a>
            <a href="#sprints" class="flex items-center space-x-4 text-white/60 hover:text-cyan-400 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-white/5">
                <i class="fas fa-layer-group"></i>
                <span>Sprints</span>
            </a>
            <a href="#sprints" class="flex items-center space-x-4 text-white/60 hover:text-cyan-400 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-white/5">
                <i class="fas fa-layer-group"></i>
                <span>Classes</span>
            </a>
            <a href="#sprints" class="flex items-center space-x-4 text-white/60 hover:text-cyan-400 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all hover:bg-white/5">
                <i class="fas fa-layer-group"></i>
                <span>Competences</span>
            </a>
        </nav>

        <div class="mt-auto pt-6 border-t border-white/5">
            <a href="/logout" class="w-full flex items-center space-x-4 text-red-400/60 hover:text-red-400 px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all">
                <i class="fas fa-power-off"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 p-4 md:p-8 overflow-y-auto">

        <div class="glass-card rounded-[1.5rem] p-4 mb-8 flex justify-between items-center px-8 animate-fade-in">
            <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-sm italic">Système d'administration</h2>
            <div class="flex items-center space-x-4">
                @foreach($users as $user)
                    @if($user->id === Auth::user()->id)
                        <div class="text-right">
                            <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest leading-none">{{ $user->firstname }} {{ $user->firstname }}</p>
                            <p class="text-xs font-black text-white uppercase">{{ Auth::user()->role }}</p>
                        </div>
                    @endif
                @endforeach
                <div class="w-10 h-10 rounded-full border-2 border-cyan-400/50 p-0.5">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=22d3ee&color=000" class="rounded-full" alt="avatar">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-fade-in">
            <div class="glass-card p-8 rounded-[2rem] group hover:border-cyan-400/50 transition-all duration-500">
                <p class="text-cyan-400/60 text-[10px] uppercase font-black tracking-[0.2em] mb-2">Total Utilisateurs</p>
                <h3 class="text-4xl font-black tracking-tighter italic">{{ count($users) }}</h3>
                <div class="mt-4 h-1 w-12 bg-cyan-500 rounded-full group-hover:w-full transition-all duration-700"></div>
            </div>
            <div class="glass-card p-8 rounded-[2rem] group hover:border-cyan-400/50 transition-all duration-500">
                <p class="text-cyan-400/60 text-[10px] uppercase font-black tracking-[0.2em] mb-2">Total Sprints</p>
                <h3 class="text-4xl font-black tracking-tighter italic">{{ count($sprints) }}</h3>
                <div class="mt-4 h-1 w-12 bg-green-500 rounded-full group-hover:w-full transition-all duration-700"></div>
            </div>
            <div class="glass-card p-8 rounded-[2rem] group hover:border-cyan-400/50 transition-all duration-500">
                <p class="text-cyan-400/60 text-[10px] uppercase font-black tracking-[0.2em] mb-2">Total Classes</p>
                <h3 class="text-4xl font-black tracking-tighter italic">{{ count($classes) }}</h3>
                <div class="mt-4 h-1 w-12 bg-yellow-500 rounded-full group-hover:w-full transition-all duration-700"></div>
            </div>
        </div>

        <section id="users" class="mb-12 animate-fade-in" style="animation-delay: 0.2s;">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
                <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-xl italic"><i class="fas fa-users mr-3"></i>Utilisateurs</h2>
                <button onclick="toggleModal('userModal')" class="bg-cyan-400 text-black font-black px-6 py-3 rounded-xl hover:scale-105 transition-all uppercase tracking-widest text-[10px] flex items-center gap-2">
                    <i class="fas fa-plus"></i> Nouveau Membre
                </button>
            </div>
            <div class="glass-card rounded-[2.5rem] overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                    <tr class="text-cyan-400/60 text-[10px] uppercase tracking-[0.2em] border-b border-white/5">
                        <th class="p-8">Identité</th>
                        <th class="p-8">Rôle</th>
                        <th class="p-8">Contact</th>
                        <th class="p-8 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-sm">
                    @foreach($users as $user)
                        @if($user)
                            <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                                <td class="p-8">
                                    <p class="font-black text-white uppercase tracking-tight">{{ $user->firstname }} {{ $user->lastname }}</p>
                                    <p class="text-[9px] text-white/30 uppercase tracking-widest">ID: #4401</p>
                                </td>
                                <td class="p-8">
                                    <span class="px-3 py-1 bg-cyan-400/10 text-cyan-400 rounded-full text-[9px] font-black uppercase tracking-widest border border-cyan-400/20">{{ $user->role }}</span>
                                </td>
                                <td class="p-8 text-white/50 font-medium">{{ $user->email }}</td>
                                <td class="p-8 text-right space-x-2">
                                    <button onclick="toggleModal('EditProfileModal')" data-id="{{ $user->id }}"  class="w-8 h-8 rounded-lg bg-white/5 hover:bg-cyan-400/20 hover:text-cyan-400 transition-all text-white/40"><i class="fas fa-edit"></i></button>
                                    <button class="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-500 transition-all text-white/40"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section id="sprints" class="animate-fade-in" style="animation-delay: 0.3s;">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
                <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-xl italic"><i class="fas fa-layer-group mr-3"></i>Sprints</h2>
                <button onclick="toggleModal('SprintModal')" class="bg-cyan-400 text-black font-black px-6 py-3 rounded-xl hover:scale-105 transition-all uppercase tracking-widest text-[10px] flex items-center gap-2">
                    <i class="fas fa-plus"></i> Nouveau Sprint
                </button>
            </div>
            <div class="glass-card rounded-[2.5rem] overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                    <tr class="text-cyan-400/60 text-[10px] uppercase tracking-[0.2em] border-b border-white/5">
                        <th class="p-8">Titre du Sprint</th>
                        <th class="p-8">Période</th>
                        <th class="p-8 text-right">Actions</th>
                    </tr>
                    </thead>
                    @foreach($sprints as $sprint)
                        <tbody class="text-sm">
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                            <td class="p-8 font-black text-white uppercase tracking-tight italic">{{ $sprint->nom }}</td>
                            <td class="p-8">
                                <div class="flex items-center gap-3 text-white/50">
                                    <i class="far fa-calendar-alt text-cyan-400/50"></i>
                                    <span>19 Jan - 26 Jan 2026</span>
                                </div>
                            </td>
                            <td class="p-8 text-right space-x-2">
                                <button class="w-8 h-8 rounded-lg bg-white/5 hover:bg-cyan-400/20 hover:text-cyan-400 transition-all text-white/40"><i class="fas fa-edit"></i></button>
                                <button class="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-500 transition-all text-white/40"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </section>

        <section id="classes" class="animate-fade-in mt-12" style="animation-delay: 0.4s;">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
                <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-xl italic">
                    <i class="fas fa-chalkboard mr-3"></i>Gestion des Classes
                </h2>
                <div class="flex flex-row justify-evenly gap-4">
                    <button onclick="toggleModal('ClassModal')" class="bg-cyan-400 text-black font-black px-6 py-3 rounded-xl hover:scale-105 transition-all uppercase tracking-widest text-[10px] flex items-center gap-2">
                        <i class="fas fa-plus"></i> Nouvelle Classe
                    </button>
                    <button onclick="toggleModal('AssignModal')" class="bg-cyan-400 text-black font-black px-6 py-3 rounded-xl hover:scale-105 transition-all uppercase tracking-widest text-[10px] flex items-center gap-2">
                        <i class="fas fa-plus"></i> Assigner Les Formateurs
                    </button>
                </div>
            </div>

            <div class="glass-card rounded-[2.5rem] overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                    <tr class="text-cyan-400/60 text-[10px] uppercase tracking-[0.2em] border-b border-white/5">
                        <th class="p-8">Nom de la Classe</th>
                        <th class="p-8">Formateur</th>
                        <th class="p-8">Effectif</th>
                        <th class="p-8 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-sm">
                    @foreach($classes as $classe)
                        <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors group">
                            <td class="p-8">
                                <p class="font-black text-white uppercase tracking-tight italic">{{ $classe->nom }}</p>
                                <p class="text-[9px] text-white/30 uppercase tracking-widest">ID: {{ $classe->id }}</p>
                            </td>
                            <td class="p-8">
                                <div class="flex items-center gap-3">
                                    @foreach($classe->formateurs as $formateur)
                                        {{ $formateur->firstname }} {{ $formateur->lastname }}
                                    @endforeach
                                </div>
                            </td>
                            <td class="p-8">
                                <div class="flex items-center gap-2 text-white/50">
                                    <i class="fas fa-users text-cyan-400/50 text-xs"></i>
                                    <span>{{ $classe->nombre }}</span>
                                </div>
                            </td>
                            <td class="p-8 text-right space-x-2">
                                <button title="Modifier" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-cyan-400/20 hover:text-cyan-400 transition-all text-white/40">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button title="Supprimer" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-500 transition-all text-white/40">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section id="competences" class="animate-fade-in mt-12" style="animation-delay: 0.5s;">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
                <div>
                    <h2 class="text-cyan-400 font-black uppercase tracking-[0.3em] text-xl italic">
                        <i class="fas fa-brain mr-3"></i>Référentiel Compétences
                    </h2>
                    <p class="text-[9px] text-white/30 uppercase tracking-widest mt-1">Dictionnaire des aptitudes techniques (Gestion Admin)</p>
                </div>
                <button onclick="toggleModal('SkillModal')" class="bg-cyan-400 text-black font-black px-6 py-3 rounded-xl hover:scale-105 transition-all uppercase tracking-widest text-[10px] flex items-center gap-2 shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                    <i class="fas fa-plus"></i> Créer Compétence
                </button>
            </div>

            <div class="glass-card rounded-[2.5rem] overflow-hidden border border-white/5">
                <table class="w-full text-left">
                    <thead>
                    <tr class="text-cyan-400/60 text-[10px] uppercase tracking-[0.2em] border-b border-white/5 bg-white/[0.02]">
                        <th class="p-8">Nom de la Compétence</th>
                        <th class="p-8 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-sm">
                    @foreach($competences as $competence)
                        <tr class="border-b border-white/5 hover:bg-cyan-400/[0.03] transition-colors group">
                            <td class="p-8">
                                <div class="flex items-center gap-4">
                                    <div class="w-2 h-8 bg-cyan-400 rounded-full shadow-[0_0_10px_rgba(34,211,238,0.5)]"></div>
                                    <p class="font-black text-white uppercase tracking-tight italic">{{ $competence->nom }}</p>
                                </div>
                            </td>
                            <td class="p-8 text-right space-x-2">
                                <button class="w-8 h-8 rounded-lg bg-white/5 hover:bg-cyan-400/20 hover:text-cyan-400 transition-all text-white/40"><i class="fas fa-edit"></i></button>
                                <button class="w-8 h-8 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-500 transition-all text-white/40"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>


<div id="userModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border-cyan-400/30">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-white text-2xl font-black italic uppercase tracking-tighter">Nouveau <span class="text-cyan-400">Membre</span></h3>
            <button onclick="toggleModal('userModal')" class="text-white/20 hover:text-white"><i class="fas fa-times"></i></button>
        </div>
        <form class="space-y-6" action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4 text-left">
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2">Nom</label>
                    <input type="text" name="nom" placeholder="Ex: Jean" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2">Prenom</label>
                    <input type="text" name="prenom" placeholder="Ex: Jean Rojer" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2">Rôle</label>
                <select name="role" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all appearance-none">
                    <option value="Etudiant" class="bg-zinc-900">Etudiant</option>
                    <option value="Formateur" class="bg-zinc-900">Formateur</option>
                </select>
            </div>
            <div class="space-y-2 text-left">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2">Email YouCode</label>
                <input name="email" type="email" placeholder="nom@youcode.ma" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
            </div>

            <div class="space-y-2 text-left">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2">Email YouCode</label>
                <input name="password" type="password" placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
            </div>
            <button type="submit" class="w-full bg-white text-black font-black py-4 rounded-2xl uppercase tracking-[0.2em] text-xs hover:bg-cyan-400 transition-all">Enregistrer</button>
        </form>
    </div>
</div>

<div id="SprintModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border-cyan-400/30">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-white text-2xl font-black italic uppercase tracking-tighter">Créer <span class="text-cyan-400">Sprint</span></h3>
            <button onclick="toggleModal('SprintModal')" class="text-white/20 hover:text-white"><i class="fas fa-times"></i></button>
        </div>
        <form class="space-y-6 text-left" action="{{ route('admin.sprint') }}" method="POST">
            @csrf
            <div class="space-y-2">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2">Titre du Sprint</label>
                <input type="text" name="titre" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2">Début</label>
                    <input type="date" name="date_debut" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50">
                </div>
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2">Fin</label>
                    <input type="date" name="date_fin" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50">
                </div>
            </div>
            <button type="submit" class="w-full bg-cyan-400 text-black font-black py-4 rounded-2xl uppercase tracking-[0.2em] text-xs hover:bg-white transition-all">Lancer le Sprint</button>
        </form>
    </div>
</div>

<div id="ClassModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border-cyan-400/30 animate-fade-in">

        <div class="flex justify-between items-center mb-8">
            <h3 class="text-white text-2xl font-black italic uppercase tracking-tighter">
                Nouvelle <span class="text-cyan-400">Classe</span>
            </h3>
            <button onclick="toggleModal('ClassModal')" class="text-white/20 hover:text-white transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('admin.classe') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-2 text-left">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Nom de la promotion</label>
                <div class="relative group">
                    <i class="fas fa-graduation-cap absolute left-5 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-cyan-400 transition-colors"></i>
                    <input type="text" name="class_name" required
                           class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-12 pr-5 text-white outline-none focus:border-cyan-400/50 focus:bg-white/[0.08] transition-all"
                           placeholder="Ex: FEBE-2026">
                </div>
            </div>

            <div class="space-y-2 text-left">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Effectif Max</label>
                <div class="relative group">
                    <i class="fas fa-users absolute left-5 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-cyan-400 transition-colors"></i>
                    <input type="number" name="capacity"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-12 pr-5 text-white outline-none focus:border-cyan-400/50 transition-all"
                           placeholder="Ex: 25">
                </div>
            </div>


            <div class="space-y-2 text-left">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Promotion</label>
                <div class="relative group">
                    <i class="fas fa-users absolute left-5 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-cyan-400 transition-colors"></i>
                    <input type="text" name="annee_scolaire"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-12 pr-5 text-white outline-none focus:border-cyan-400/50 transition-all"
                           placeholder="EX: 2025/2026">
                </div>
            </div>

            <button type="submit"
                    class="relative overflow-hidden w-full bg-white text-black font-black py-4 rounded-2xl transition-all duration-500 transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-[0.3em] text-xs group">
                <span class="relative z-10">Confirmer la Création</span>
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-cyan-400/30 to-transparent -translate-x-full group-hover:animate-[shimmer_2s_infinite]"></div>
            </button>

        </form>
    </div>
</div>

<div id="AssignModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border-cyan-400/30 animate-fade-in shadow-[0_0_50px_rgba(34,211,238,0.15)]">

        <div class="flex justify-between items-center mb-8">
            <div class="text-left">
                <h3 class="text-white text-2xl font-black italic uppercase tracking-tighter leading-none">
                    Assigner <span class="text-cyan-400">Formateur</span>
                </h3>
                <p class="text-[9px] text-white/30 uppercase tracking-[0.3em] mt-2">
                    Liaison Classe & Enseignant
                </p>
            </div>
            <button onclick="toggleModal('AssignModal')" class="text-white/20 hover:text-white transition-all hover:rotate-90">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('admin.assiner') }}">
            @csrf
            <div class="space-y-2 text-left group">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">
                    Sélectionner la Classe
                </label>
                <div class="relative">
                    <i class="fas fa-chalkboard absolute left-5 top-1/2 -translate-y-1/2 text-white/20"></i>
                    <select name="class_id" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-12 pr-5 text-white outline-none focus:border-cyan-400/50 appearance-none cursor-pointer">

                        <option value="" class="bg-zinc-900">Choisir une classe...</option>

                        @foreach($classes as $classe)
                            <option value="{{ $classe->id }}" class="bg-zinc-900">
                                {{ $classe->nom }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-[10px] text-white/20"></i>
                </div>
            </div>

            <div class="space-y-2 text-left group mt-6">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">
                    Formateur à Assigner
                </label>
                <div class="relative">
                    <i class="fas fa-user-tie absolute left-5 top-1/2 -translate-y-1/2 text-white/20"></i>
                    <select name="teacher_id" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 pl-12 pr-5 text-white outline-none focus:border-cyan-400/50 appearance-none cursor-pointer">

                        <option value="" class="bg-zinc-900">Choisir un formateur...</option>

                        @foreach($users as $user)
                            @if($user->role === 'Formateur')
                                <option value="{{ $user->id }}" class="bg-zinc-900 uppercase">
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-[10px] text-white/20"></i>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" name="assigneformateur"
                        class="relative overflow-hidden w-full bg-white text-black font-black py-4 rounded-2xl uppercase tracking-[0.3em] text-xs shadow-[0_10px_20px_rgba(0,0,0,0.3)]">
                    <span class="relative z-10 flex items-center justify-center gap-3">
                        <i class="fas fa-link"></i> Finaliser l'assignation
                    </span>
                </button>
            </div>

        </form>
    </div>
</div>
<div id="SkillModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border-cyan-400/30 animate-fade-in shadow-[0_0_50px_rgba(34,211,238,0.1)]">

        <div class="flex justify-between items-center mb-10">
            <h3 class="text-white text-2xl font-black italic uppercase tracking-tighter italic">
                Nouvelle <span class="text-cyan-400">Compétence</span>
            </h3>
            <button onclick="toggleModal('SkillModal')" class="text-white/20 hover:text-white transition-all"><i class="fas fa-times text-xl"></i></button>
        </div>

        <form action="{{ route('admin.skills') }}" method="POST" class="space-y-8">
            @csrf
            <div class="space-y-2 group text-left">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-4 italic group-focus-within:text-cyan-400 transition-colors">Désignation</label>
                <div class="relative">
                    <i class="fas fa-brain absolute left-5 top-1/2 -translate-y-1/2 text-white/10 group-focus-within:text-cyan-400 transition-colors"></i>
                    <input type="text" name="competence_name" required
                           class="w-full bg-white/[0.03] border border-white/10 rounded-2xl py-5 pl-14 pr-5 text-white placeholder-white/10 focus:border-cyan-400/50 focus:bg-white/[0.08] outline-none transition-all"
                           placeholder="Ex: Programmation Asynchrone">
                </div>
            </div>
            <button type="submit"
                    class="w-full bg-white text-black font-black py-5 rounded-2xl uppercase tracking-[0.4em] text-[10px] hover:bg-cyan-400 transition-all duration-500 shadow-[0_0_30px_rgba(255,255,255,0.05)]">
                Ajouter au Référentiel
            </button>
        </form>
    </div>
</div>

<div id="EditProfileModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="glass-card w-full max-w-lg p-10 rounded-[2.5rem] border border-cyan-400/30 animate-fade-in shadow-[0_0_50px_rgba(34,211,238,0.1)]">

        <div class="flex justify-between items-center mb-8">
            <h3 class="text-white text-2xl font-black italic uppercase tracking-tighter">
                Modifier <span class="text-cyan-400">Profil</span>
            </h3>
            <button onclick="toggleModal('EditProfileModal')" class="text-white/20 hover:text-white transition-all">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form action="/user/update" method="POST" class="space-y-5">
            <input type="text" id="id" name="id" placeholder="">

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Prénom</label>
                    <input type="text" name="firstname" value="{{ $user->firstname }}"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Nom</label>
                    <input type="text" name="lastname" value="{{ $user->lastname }}"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Email Professionnel</label>
                <input type="email" name="email" value="{{ $user->email }}"
                       class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
            </div>

            <div class="space-y-2">
                <label class="text-cyan-400/60 text-[9px] font-black uppercase tracking-widest ml-2 italic">Nom d'utilisateur</label>
                <input type="text" name="username" value=""
                       class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-white outline-none focus:border-cyan-400/50 transition-all">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-white text-black font-black py-5 rounded-2xl uppercase tracking-[0.3em] text-xs hover:bg-cyan-400 transition-all duration-500 shadow-[0_10px_30px_rgba(255,255,255,0.05)]">
                    Sauvegarder les modifications
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    document.getElementById('id').value = getAttribue('data-id');
</script>
</body>
</html>
