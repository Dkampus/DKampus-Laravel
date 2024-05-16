<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Addresse;
use App\Models\Data_umkm;
use App\Models\Menu;
use App\Models\Footer;
use Illuminate\Http\Request;
use App\Models\HomeModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $alamat = Addresse::where('user_id', Auth::user()->id)->where('utama', 1)->first();
            $listJarak = [];

            foreach (Data_umkm::all() as $data) {
                $listJarak[] = $this->calculteDistance($alamat->geo, $data->geo);
            }
            return view('pages.Users.Homepage', [
                'Banner' => HomeModel::bannerData(),
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
                'Carousel' => HomeModel::carouselData(),
                'CarouselDesktop' => HomeModel::carouselDesktopData(),
                'RekomendasiWarung' => Data_umkm::all(),
                'RekomendasiMakanan' => Menu::take(5)->get(),
                'FooterPart1' => Footer::footerPart1(),
                'FooterPart2Beli' => Footer::footerPart2Beli(),
                'FooterPart2Jual' => Footer::footerPart2Jual(),
                'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
                'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
                'Title' => 'Home',
                'alamat' => $alamat,
                'listJarak' => $listJarak,
            ]);
        } catch (Exception $e) {
            dd($e);
            return view('pages.Users.Homepage', [
                'Banner' => HomeModel::bannerData(),
                'PengaturanAkun' => HomeModel::pengaturanAkun(),
                'SeputarDkampus' => HomeModel::seputarDkampus(),
                'Carousel' => HomeModel::carouselData(),
                'CarouselDesktop' => HomeModel::carouselDesktopData(),
                'RekomendasiWarung' => Data_umkm::all(),
                'RekomendasiMakanan' => Menu::take(5)->get(),
                'FooterPart1' => Footer::footerPart1(),
                'FooterPart2Beli' => Footer::footerPart2Beli(),
                'FooterPart2Jual' => Footer::footerPart2Jual(),
                'FooterPart3KeamananDanPrivasi' => Footer::footerPart3KeamananDanPrivasi(),
                'FooterPart3IkutiKami' => Footer::footerPart3IkutiKami(),
                'Title' => 'Home',
            ]);
        }
    }

    private function calculteDistance($from, $to)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        $client = new Client();

        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&key=$apiKey";

        $response = $client->get($url);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
            $distance = $data['rows'][0]['elements'][0]['distance']['value'];
            return $distance;
        } else {
            return back()->withErrors(['error2' => 'Failed to calculate distance.']);
        }
    }

    public function login()
    {
        return view('pages.Users.Login', [
            'Title' => 'Log in',
            'PengaturanAkun' => HomeModel::pengaturanAkun(),
            'SeputarDkampus' => HomeModel::seputarDkampus(),
        ]);
    }

    public function register()
    {
        return view('pages.Users.Register', [
            'Title' => 'Register',
        ]);
    }

    public function indexAlamat()
    {
        $userID = Auth::user()->id;
        $alamat = User::find($userID);
        $dataAlamat = $alamat->addresses()->get();
        return view('pages.Users.DaftarAlamat', [
            'Title' => 'Daftar Alamat',
            'alamatUser' => $dataAlamat,
        ]);
    }

    public function daftarAlamat(Request $request)
    {
        // dd($request->geo);
        $userId = Auth::user()->id;
        try {
            $validatedData = $request->validate([
                'address' => 'required',
                'link' => 'required',
                'namaAlamat' => 'required',

            ]);
            Addresse::create([
                'user_id' => $userId,
                'address' => $request->address,
                'link' => $request->link,
                'nama_alamat' => $request->namaAlamat,
                'geo' => $request->geo,
            ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function code_verification()
    {
        return view('pages.Users.CodeVerification', [
            'Title' => 'Code Verification'
        ]);
    }

    public function input_register()
    {
        return view('pages.Users.InputRegister', [
            'Title' => 'Pesanan',
        ]);
    }

    public function atur_ulang_kata_sandi()
    {
        return view('pages.Users.AturUlangKataSandi', [
            'Title' => 'Atur Ulang Kata Sandi',
        ]);
    }

    public function alamatUtama()
    {
        $checkAddress = Addresse::where('user_id', request()->custId)->where('utama', 1)->first();
        // dd($checkAddress);
        if ($checkAddress) {
            $checkAddress->update(['utama' => 0]);
            Addresse::where('id', request()->id)->update(['utama' => 1]);
        } else {
            Addresse::where('id', request()->id)->update(['utama' => 1]);
        }

        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
