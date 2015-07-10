<?php
/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace WebRequest;

/**
 * Classe para realizar as chamadas de requisição via cURL.
 */
class cURL extends HttpRequest
{
    /**
     * Construtor para a classe de requisições Web utilizando cURL para leitura dos dados.
     */
    protected function __construct()
    {
        if(extension_loaded('curl') === false)
        {
            throw new \Exception("Biblioteca cURL não foi carregada. Verifique as configurações do seu PHP e tente novamente.");
        }
    }

    /**
     * @see IHttpRequest::execute()
     */
    public function execute($url, $data = [], $method = 'GET', $header = [])
    {
        $return = null;
        // Inicializa o gancho para o cURL executar.
        $cl = curl_init();

        // Define as opções principais do cURL.
        curl_setopt($cl, CURLOPT_URL, $url);
        curl_setopt($cl, CURLOPT_CUSTOMREQUEST, $method); // Para os métodos de execução.
        curl_setopt($cl, CURLOPT_HEADER, false);
        curl_setopt($cl, CURLOPT_SSL_VERIFYPEER, false);

        // Caso não seja do tipo get a ser executado, então define que será enviado POST.
        // Constroi os dados a serem enviados.
        if($method != 'GET')
        {
            curl_setopt($cl, CURLOPT_POST, 1);
            curl_setopt($cl, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        // Caso existam cabeçalhos a serem enviados pela requisição, define-os aqui.
        if(count($header) > 0)
        {
            curl_setopt($cl, CURLOPT_HTTPHEADER, $header);
        }
        // Define que todos os dados da requisição serão retornados pela execução.
        curl_setopt($cl, CURLOPT_RETURNTRANSFER, true);
        // Executa a requisição e obtem os dados.
        $return = curl_exec($cl);

        // Caso exista erros de execução, lança uma exception.
        if(curl_errno($cl) > 0)
        {
            throw new \Exception(curl_error($cl));
        }

        // Encerra o gancho do cURL.
        curl_close($cl);
        // Retorna os dados para a chamada.
        return $return;
    } // fim - public function execute($url, $data = [], $method = 'GET', $header = [])
}

