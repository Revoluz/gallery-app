<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gallery;
// use ArielMejiaDev\LarapexCharts\LarapexChart as chart;
use App\Charts\TrafficChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ArielMejiaDev\LarapexCharts\LarapexChart;

// use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class AdminController extends Controller
{
    public function traffic($year, TrafficChart $trafficChart)
    {
        $data = Gallery::whereYear('created_at', $year)
            ->selectRaw('COUNT(*) as total, MONTH(created_at) as month')
            ->groupBy('month')
            ->get();
        $month = [];
        $total = [];

        foreach ($data as $item) {
            $month[] = Carbon::parse('2023-' . $item->month . '-01')->format('F'); // Gunakan Carbon untuk konversi fungsi format(f) hanya mengambil bulan saja
            $item->month = Carbon::parse('2023-' . $item->month . '-01')->format('F'); // Gunakan Carbon untuk konversi
            $total[] = $item->total;
        }
        // dd($data);
        $years = Gallery::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');
        // dd($years);

        // 'trafficChart' => $trafficChart->build($month, $total, $year),
        // dd($month);
        return view('admin.traffic', [
            'month' => $month,
            'total' => $total,
            'data' => $data,
            'year' => Carbon::now()->year,
            'years' => $years,

        ]);
    }
    public function dataUser()
    {
        return view('admin.data-user', [
            'year' => Carbon::now()->year,
            'users' => User::all()
        ]);
    }
    public function destroy(User $user)
    {
        // $this->authorize('auth.guard', $user);
        if ($user->galleries) {
            // Hapus galeri terkait
            // dd($user);
            $user->galleries->each(function ($image) {
                // Storage::disk('public')->delete('public/gallery/' . $gallery->name);
                // if (Storage::disk('public')->exists('gallery/' . $gallery->name)) {
                //     Storage::disk('public')->delete('gallery/' . $gallery->name);
                // }
                if (Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
            });
        }
        // Hapus foto profil jika ada
        if ($user->profile->photo) {
            if (Storage::disk('public')->exists($user->profile->photo)) {
                Storage::disk('public')->delete($user->profile->photo);
            }
        }
        $user->delete();
        return redirect()->back()->with('succes', 'Successfully delete user');
    }
    public function dataImage()
    {
        return view('admin.data-image', [
            'images' => Gallery::all(),
            'year' => Carbon::now()->year,
        ]);
    }
    public function changeStatus(Gallery $image)
    {
        $image->status = !$image->status;
        $image->save();

        return redirect()->back()->with('success', 'Succesfully updated status image');
    }
}
