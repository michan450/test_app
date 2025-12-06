<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->name) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if ($request->email) {
            $query->where('email', 'like', "%{$request->email}%");
        }
        if ($request->gender && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->category) {
            $query->where('category', $request->category);
        }
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->latest()->paginate(7)->withQueryString();
        foreach ($contacts as $contact) {
    
           $contact->gender = [
             1 => '男性',
             2 => '女性',
             3 => 'その他'
           ][$contact->gender] ?? $contact->gender;

    
             $contact->category = [
             1 => '商品のお届けについて',
             2 => '商品の交換について',
             3 => '商品トラブル',
             4 => 'ショップへのお問い合わせ',
             5 => 'その他'
            ][$contact->category] ?? $contact->category;
}

        return view('admin.dashboard', compact('contacts'));
    }

    // 詳細モーダル用
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    // CSVエクスポート
    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->name) $query->where('name', 'like', "%{$request->name}%");
        if ($request->email) $query->where('email', 'like', "%{$request->email}%");
        if ($request->gender && $request->gender !== 'all') $query->where('gender', $request->gender);
        if ($request->category) $query->where('category', $request->category);
        if ($request->date) $query->whereDate('created_at', $request->date);

        $contacts = $query->get();

        $csvHeader = ['お名前','性別','メール','内容'];
        $callback = function() use ($contacts, $csvHeader) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvHeader);

            foreach ($contacts as $contact) {
                fputcsv($file, [$contact->name, $contact->gender, $contact->email, $contact->content]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=contacts.csv",
        ]);
    }
    public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return response()->json(['success' => true]);
}

}
