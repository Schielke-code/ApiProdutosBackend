<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    //Listage de todos os produtos
    public function index()
    {
        $produtos = Produtos::orderBy('id', 'DESC')->paginate(5);
        return  response()->json($produtos);
    }

    // Produtos que serão exibidos para serem adicionados na opção de kit
    public function listProdutos()
    {
        $produtos = Produtos::Where('tipo', 'PRODUTO')
            ->whereNull('produto_kit_id')
            ->get();
        return  response()->json($produtos);
    }

    public function store(Request $request)
    {


        try{
            //somando valores do item para serem passados para o kit
            $arrayProdutos = explode(',', $request->produto) ;
            if($request->kit != '0'){
                $produtosValor = Produtos::select( DB::raw('sum( preco ) as valor') )
                    ->whereIn('id', $arrayProdutos)->first();

            }else{
                $request->preco = str_replace('.','', $request->preco);
                $request->preco = str_replace(',','.', $request->preco);
            }


            $produto = new Produtos();
            $produto->categoria = $request->categoria;
            $produto->nome = $request->nomeProduto;
            $produto->descricao = $request->descricao;
            $produto->preco = isset($request->preco) ? $request->preco : $produtosValor->valor;
            $produto->tipo = $request->kit == '0' ? 'PRODUTO' : 'KIT';
            $produto->save();


            $data = Produtos::orderBy('id', 'DESC')->first();

            //condição para que o fluxo ocorra novamente caso a inserção do registro seja efetuado com sucesso
            if ($produto){
                if ($request->hasFile('fileImage') && $request->file('fileImage')->isValid()){
                    $nameImg =  $data->id.'-'.str_slug($data->nome);
                    $extension =  $request->fileImage->getClientOriginalExtension();
                    $nameFile = $nameImg.".".$extension ;
                    $upload = $request->fileImage->storeAs('imagens/produtos', $nameFile, 'public');
                    if(!$upload){
                        $error = 'Falha ao fazer o upload da imagem';
                        return redirect()->back()->with(compact('error'));
                    }
                    Produtos::where('id',  $data->id)->update(['image' => $nameFile]);
                }

                if($request->kit != '0') {
                    //se o produto for inserido com sucesso  os produtos relacionado ao kit terão suas colunas  'produto_kit_id' atualizado para o kit referente"
                    if ($produto) {
                        Produtos::whereIn('id',  $arrayProdutos)->update(['produto_kit_id' => $data->id]);
                        $produtos = Produtos::whereIn('id', $arrayProdutos)->get();

                    }
                }

                if($data->tipo == 'PRODUTO'){
                    return response()->json(['data'=> $data, 'sucesso'=> 'Operação efetuada com sucesso'], 201); ////código 201 para produto criado com sucesso
                }else{
                    return response()->json(['data'=> $data, 'produtos'=> $produtos, 'sucesso'=> 'Operação efetuada com sucesso'], 201); ////código 201 para produto criado com sucesso
                }

            }


        }catch (\Exception $exception){
            return response()->json(['data'=> $exception, 'error'=> 'Ops, encontramos um erro no modulo de Classificação. Erro interno entre em contato com o seu suporte']);
        }
    }


    public function destroy($id)
    {
        try{

            Produtos::where('produto_kit_id', $id)->update(['produto_kit_id' => null]);
            Produtos::find($id)->delete();
            $data = Produtos::get();
            $data = ['data'=> $data, 'sucesso'=> 'Operação efetuada com sucesso'];
            return  response()->json($data, 200);
        }catch (\Exception $exception){

            return response()->json(['data'=> $exception, 'error'=> 'Ops, encontramos um erro no modulo de Classificação. Erro interno entre em contato com o seu suporte']);
        }

    }
}
