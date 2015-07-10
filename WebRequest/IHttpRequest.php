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
 * Interface para as requisições web.
 */
interface IHttpRequest
{
    /**
     * Informa que a requisição deverá enviar um GET.
     *
     * @param string $url Caminho que será realizada a requisição.
     * @param array $data Dados que serão enviados pela requisição. (Padrão: Sem dados)
     * @param string $format Informa o formato que será retornado os dados. (Aceitos: json [padrão], xml e text)
     *
     * @return mixed Retorno em formato configurado.
     */
    public function get($url, $data = [], $format = 'json');

    /**
     * Informa que a requisição deverá enviar um POST.
     *
     * @param string $url Caminho que será realizada a requisição.
     * @param array $data Dados que serão enviados pela requisição. (Padrão: Sem dados)
     * @param string $format Informa o formato que será retornado os dados. (Aceitos: json [padrão], xml e text)
     *
     * @return mixed Retorno em formato configurado.
     */
    public function post($url, $data = [], $format = 'json');

    /**
     * Informa que a requisição deverá enviar um PUT.
     *
     * @param string $url Caminho que será realizada a requisição.
     * @param array $data Dados que serão enviados pela requisição. (Padrão: Sem dados)
     * @param string $format Informa o formato que será retornado os dados. (Aceitos: json [padrão], xml e text)
     *
     * @return mixed Retorno em formato configurado.
     */
    public function put($url, $data = [], $format = 'json');

    /**
     * Informa que a requisição deverá enviar um DELETE.
     *
     * @param string $url Caminho que será realizada a requisição.
     * @param array $data Dados que serão enviados pela requisição. (Padrão: Sem dados)
     * @param string $format Informa o formato que será retornado os dados. (Aceitos: json [padrão], xml e text)
     *
     * @return mixed Retorno em formato configurado.
     */
    public function delete($url, $data = [], $format = 'json');

    /**
     * Transforma os dados retornados pelo execute no formato indicado.
     *
     * @param string $returnData Dados retornados pela requisição.
     * @param string $format Informa o formato que será retornado os dados. (Aceitos: json [padrão], xml e text)
     *
     * @return mixed Retorna em formato configurado
     */
    public function parseReturn($returnData, $format = 'json');

    /**
     * Executa uma requisição http com as opções de parametro informadas.
     * 
     * @param string $url Caminho que será realizada a requisição.
     * @param string $method Tipo de cabeçalho que será informado na requisição. (Padrão: GET)
     * @param array $data Dados que serão enviados pela requisição. (Padrão: Sem dados)
     * @param array $header Informação de cabeçalho adicionais que serão utilizadas. (Padrão: Sem dados)
     *
     * @return string Retorno em formato string da requisição.
     */
    public function execute($url, $data = [], $method = 'GET', $header = []);
}
