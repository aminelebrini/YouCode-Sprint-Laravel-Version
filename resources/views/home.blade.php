<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title ?? 'YouCode Sprint' }}</title>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes borderGlow {
            0%, 100% { border-color: rgba(34, 211, 238, 0.3); shadow: 0 0 10px rgba(34, 211, 238, 0.1); }
            50% { border-color: rgba(34, 211, 238, 0.6); shadow: 0 0 20px rgba(34, 211, 238, 0.3); }
        }

        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .glow-pulse {
            animation: borderGlow 3s infinite ease-in-out;
        }
        
    </style>
</head>
<body class="bg-[url('https://42.fr/wp-content/uploads/2021/07/Background-RM-2000x1132.jpg')] bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center p-4">

    <div class="animate-fade-in absolute left-[15%] animate-glow bg-[#050505]/80 backdrop-blur-2xl p-8 md:p-12 rounded-[2rem] border border-cyan-400/30 shadow-[0_0_50px_rgba(0,0,0,0.8)] w-full max-w-md overflow-hidden">    
    
    <header class="text-center mb-10 relative">
        <h1 class="text-white text-4xl font-black italic uppercase tracking-tighter mb-1 transition-all duration-500 hover:tracking-normal">
            YouCode <br>
            <span class="text-cyan-400 inline-block ml-[20%]">Sprint</span>
        </h1>
        <div class="h-[2px] w-[50%] bg-cyan-500 mx-auto rounded-full"></div>
    </header>

    <form action="/get_profile" method="POST" class="space-y-6">
        <div class="relative group">
            <label class="text-cyan-400/60 text-[9px] uppercase font-black mb-1.5 block ml-4 tracking-[0.2em] group-focus-within:text-cyan-400 transition-colors">Identifiant YouCode</label>
            <input type="text" name="email" required
                class="w-full bg-white/[0.03] border border-white/10 rounded-2xl py-4 px-5 text-white placeholder-white/10 focus:border-cyan-400/50 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-400/5 outline-none transition-all duration-300"
                placeholder="nomprenom@youcode.ma">
        </div>

        <div class="relative group">
            <div class="flex justify-between items-center mb-1.5 px-4">
                <label class="text-cyan-400/60 text-[9px] uppercase font-black tracking-[0.2em] group-focus-within:text-cyan-400 transition-colors">Clé d'accès</label>
                <a href="#" class="text-[9px] text-white/30 hover:text-cyan-400 transition-colors uppercase tracking-widest">Oublié ?</a>
            </div>
            <input type="password" name="password" required
                class="w-full bg-white/[0.03] border border-white/10 rounded-2xl py-4 px-5 text-white placeholder-white/10 focus:border-cyan-400/50 focus:bg-white/[0.07] focus:ring-4 focus:ring-cyan-400/5 outline-none transition-all duration-300"
                placeholder="••••••••">
        </div>

        <button type="submit" name="login"
            class="relative overflow-hidden w-full bg-white text-black font-black py-4 rounded-2xl transition-all duration-500 transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-[0.3em] text-sm group">
            
            <span class="relative z-10 group-hover:text-cyan-600 transition-colors">SE CONNECTER</span>
            
            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-cyan-400/20 to-transparent -translate-x-full group-hover:animate-[shimmer-fast_1.5s_infinite]"></div>
            
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-[inset_0_0_20px_rgba(34,211,238,0.4)]"></div>
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-white/5 text-center">
        <p class="text-[15px] text-white/40 uppercase tracking-[0.2em]"> Powered by YouCode <span class="text-cyan-500/50">v2.4.0</span></p>
    </div>
</div>


</body>
</html>